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
} elseif ($action === 'suspend_provider' && !empty($id)) {
    $providerId = (int)$id;
    foreach ($_SESSION['wedalink_providers'] as &$provider) {
        if ($provider['id'] === $providerId) {
            $provider['status'] = 'suspended';
            array_unshift($_SESSION['wedalink_logs'], [
                'id' => time(),
                'action' => "Admin suspended provider account {$provider['name']} ({$provider['trade']})",
                'detail' => 'Compliance audit flag triggered',
                'time' => 'Just now',
                'type' => 'suspension'
            ]);
            $response = ['success' => true, 'message' => "Provider #{$providerId} suspended."];
            break;
        }
    }
} elseif ($action === 'export_csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=wedalink_provider_directory_' . date('Ymd_His') . '.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Full Name', 'NIC', 'Trade', 'Specialization', 'Phone', 'City', 'Province', 'Experience', 'Status', 'Registered Date']);
    foreach ($_SESSION['wedalink_providers'] as $p) {
        fputcsv($output, [
            $p['id'],
            $p['name'],
            $p['nic'] ?? '',
            $p['trade'],
            $p['specialization'] ?? '',
            $p['phone'],
            $p['city'] ?? $p['location'],
            $p['province'] ?? '',
            $p['experience'],
            $p['status'],
            ($p['registered_day'] ?? '') . ' ' . ($p['registered_time'] ?? '')
        ]);
    }
    fclose($output);
    exit;
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
