<?php

namespace App\Services;

use App\Models\User;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class GoogleSSOService
{
    /**
     * Get the Google login redirect URL
     */
    public static function getLoginUrl(): string
    {
        return route('sso.redirect', ['provider' => 'google']);
    }

    /**
     * Handle Google OAuth callback and authenticate user
     */
    public static function authenticate(): User
    {
        $googleUser = Socialite::driver('google')->user();

        return self::findOrCreateUser($googleUser);
    }

    /**
     * Find existing user or create new one from Google user data
     */
    public static function findOrCreateUser(SocialiteUser $googleUser): User
    {
        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? $googleUser->getEmail(),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'is_verified' => true,
                'role' => 'user', // Default role
            ]
        );

        // Update provider info if user exists but doesn't have Google linked
        if ($user->provider !== 'google') {
            $user->update([
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'is_verified' => true,
            ]);
        }

        return $user;
    }

    /**
     * Check if user is linked with Google
     */
    public static function isUserLinkedWithGoogle(User $user): bool
    {
        return $user->provider === 'google' && !empty($user->provider_id);
    }

    /**
     * Unlink Google account from user
     */
    public static function unlinkGoogle(User $user): bool
    {
        if (self::isUserLinkedWithGoogle($user)) {
            // Only unlink if user has a password (can login via password)
            if (!empty($user->password)) {
                return $user->update([
                    'provider' => null,
                    'provider_id' => null,
                ]);
            }
        }

        return false;
    }

    /**
     * Get Google provider info for user
     */
    public static function getProviderInfo(User $user): ?array
    {
        if (!self::isUserLinkedWithGoogle($user)) {
            return null;
        }

        return [
            'provider' => $user->provider,
            'provider_id' => $user->provider_id,
            'avatar' => $user->avatar,
            'linked_at' => $user->updated_at,
        ];
    }

    /**
     * Check if email exists in database
     */
    public static function emailExists(string $email): bool
    {
        return User::where('email', $email)->exists();
    }

    /**
     * Get user by Google provider ID
     */
    public static function getUserByProviderId(string $providerId): ?User
    {
        return User::where('provider', 'google')
            ->where('provider_id', $providerId)
            ->first();
    }
}
