<?php
$admin = App\Models\User::where('email', 'admin@example.com')->first();
$otherUser = App\Models\User::factory()->create();
$post = App\Models\Post::factory()->create(['user_id' => $otherUser->id]);

echo "Admin ID: " . $admin->id . "\n";
echo "Other User ID: " . $otherUser->id . "\n";
echo "Post User ID: " . $post->user_id . "\n";

$canUpdate = $admin->can('update', $post);
echo $canUpdate ? 'ADMIN_CAN_UPDATE' : 'ADMIN_CANNOT_UPDATE';
echo "\n";
