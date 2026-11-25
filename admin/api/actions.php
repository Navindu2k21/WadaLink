<?php
/**
 * WedaLink Admin Actions API Endpoint
 */
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../includes/config.php';

$action = $_GET['action'] ?? '';
$id = $_GET['id'] ?? '';

$response = ['success' => false, 'message' => 'Invalid action'];

if ($action === 'approve_provider' && !empty($id)) {
    $providerId = (int)$id;
    foreach ($_SESSION['wedalink_providers'] as &$provider) {
        if ($provider['id'] === $providerId) {
            $provider['status'] = 'approved';
            if ($_SESSION['wedalink_stats']['pending_approvals'] > 0) {
                $_SESSION['wedalink_stats']['pending_approvals']--;
            }
            array_unshift($_SESSION['wedalink_logs'], [
                'id' => time(),
                'action' => "Admin approved provider {$provider['name']} ({$provider['trade']} - {$provider['location']})",
                'detail' => 'Verification checklist complete (NVQ Cert validated)',
                'time' => 'Just now',
                'type' => 'approval'
            ]);
            $response = ['success' => true, 'message' => "Provider #{$providerId} approved."];
            break;
        }
    }
} elseif ($action === 'reject_provider' && !empty($id)) {
    $providerId = (int)$id;
    $reason = $_GET['reason'] ?? 'Incomplete documentation';
    foreach ($_SESSION['wedalink_providers'] as &$provider) {
        if ($provider['id'] === $providerId) {
            $provider['status'] = 'rejected';
            if ($_SESSION['wedalink_stats']['pending_approvals'] > 0) {
                $_SESSION['wedalink_stats']['pending_approvals']--;
            }
            array_unshift($_SESSION['wedalink_logs'], [
                'id' => time(),
                'action' => "Admin rejected provider {$provider['name']} ({$provider['trade']})",
                'detail' => "Reason: {$reason}",
                'time' => 'Just now',
                'type' => 'rejection'
            ]);
            $response = ['success' => true, 'message' => "Provider #{$providerId} rejected."];
            break;
        }
    }
} elseif ($action === 'approve_listing' && !empty($id)) {
    foreach ($_SESSION['wedalink_listings'] as &$item) {
        if ($item['id'] === $id) {
            $item['status'] = 'approved';
            array_unshift($_SESSION['wedalink_logs'], [
                'id' => time(),
                'action' => "Admin approved listing #{$id}",
                'detail' => "Published to public marketplace",
                'time' => 'Just now',
                'type' => 'listing'
            ]);
            $response = ['success' => true, 'message' => "Listing #{$id} approved."];
            break;
        }
    }
} elseif ($action === 'remove_listing' && !empty($id)) {
    foreach ($_SESSION['wedalink_listings'] as &$item) {
        if ($item['id'] === $id) {
            $item['status'] = 'removed';
            array_unshift($_SESSION['wedalink_logs'], [
                'id' => time(),
                'action' => "Admin removed listing #{$id}",
                'detail' => "Flagged as duplicate/redundant in node moderation",
                'time' => 'Just now',
                'type' => 'removal'
            ]);
            $response = ['success' => true, 'message' => "Listing #{$id} removed."];
            break;
        }
    }
} elseif ($action === 'get_stats') {
    $response = [
        'success' => true,
        'stats' => $_SESSION['wedalink_stats'],
        'pending_providers_count' => getPendingProvidersCount(),
        'pending_listings_count' => getPendingListingsCount()
    ];
}

echo json_encode($response);
