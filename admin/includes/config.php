<?php
/**
 * WedaLink Admin Panel Configuration & State Store
 * Timezone: Asia/Colombo (SLST UTC +5:30)
 */
declare(strict_types=1);

// Ensure local session storage is available and writable
$sessionDir = __DIR__ . '/../sessions';
if (!is_dir($sessionDir)) {
    @mkdir($sessionDir, 0777, true);
}
if (is_dir($sessionDir) && is_writable($sessionDir)) {
    @session_save_path($sessionDir);
}

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

date_default_timezone_set('Asia/Colombo');

define('APP_NAME', 'WedaLink');
define('APP_TAGLINE', 'CONTROL CENTER');
define('APP_TIMEZONE', 'SLST (UTC +5:30)');
define('ADMIN_NAME', 'A.K.N.M. Alahakoon');
define('ADMIN_ROLE', 'System Admin');
define('ADMIN_INITIALS', 'AA');

// Initialize demo state in session so user interactions persist
if (!isset($_SESSION['wedalink_data_initialized'])) {
    $_SESSION['wedalink_stats'] = [
        'pending_approvals' => 5,
        'active_jobs' => 28,
        'active_equipment' => 14,
        'flagged_reviews' => 2,
    ];

    $_SESSION['wedalink_provinces'] = [
        'Western' => 19,
        'Central' => 6,
        'North Western' => 3,
    ];

    $_SESSION['wedalink_providers'] = [
        [
            'id' => 1,
            'name' => 'Kasun Perera',
            'trade' => 'Electrician',
            'location' => 'Colombo 07',
            'registered_time' => '25 mins ago',
            'phone' => '+94 77 123 4567',
            'experience' => '8 Years (NVQ-4)',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'avatar' => 'https://images.unsplash.com/photo-1540569014015-19a7be504e3a?w=150&auto=format&fit=crop&q=80',
            'status' => 'pending'
        ],
        [
            'id' => 2,
            'name' => 'Nimal Fernando',
            'trade' => 'Plumber',
            'location' => 'Kandy Central',
            'registered_time' => '1 hour ago',
            'phone' => '+94 71 890 1234',
            'experience' => '6 Years (Commercial)',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=150&auto=format&fit=crop&q=80',
            'status' => 'pending'
        ],
        [
            'id' => 3,
            'name' => 'Ruwan Jayasinghe',
            'trade' => 'AC Tech',
            'location' => 'Kurunegala',
            'registered_time' => '3 hours ago',
            'phone' => '+94 76 543 2109',
            'experience' => '5 Years (Inverter ACs)',
            'nic_status' => 'Police Clearance Pending',
            'nic_verified' => false,
            'police_clearance' => 'Pending',
            'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=150&auto=format&fit=crop&q=80',
            'status' => 'pending'
        ],
        [
            'id' => 4,
            'name' => 'Chamath Wickramasinghe',
            'trade' => 'Electrician',
            'location' => 'Gampaha',
            'registered_time' => '5 hours ago',
            'phone' => '+94 72 334 5566',
            'experience' => '4 Years (Domestic/Solar)',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=150&auto=format&fit=crop&q=80',
            'status' => 'pending'
        ],
        [
            'id' => 5,
            'name' => 'Dinesh Bandara',
            'trade' => 'Plumber',
            'location' => 'Negombo',
            'registered_time' => '8 hours ago',
            'phone' => '+94 78 998 1122',
            'experience' => '7 Years (Industrial Pipes)',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'avatar' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=150&auto=format&fit=crop&q=80',
            'status' => 'pending'
        ],
    ];

    $_SESSION['wedalink_listings'] = [
        [
            'id' => 'REQ-8821',
            'title' => 'Emergency Water Leak in Bathroom Ceiling',
            'type' => 'request',
            'category' => 'Plumbing',
            'match_score' => '98% Match',
            'author' => 'Malik Samarakoon (Battaramulla)',
            'author_type' => 'user',
            'price_or_match' => '98% Match',
            'time' => '15m ago',
            'status' => 'pending'
        ],
        [
            'id' => 'EQ-3092',
            'title' => 'Bosch Rotary Hammer Drill (GBH 2-26)',
            'type' => 'equipment',
            'category' => 'Equipment Rental',
            'match_score' => 'LKR 1,500/day',
            'author' => 'Lanka Tool Hire (Maharagama)',
            'author_type' => 'business',
            'price_or_match' => 'LKR 1,500/day',
            'time' => '32m ago',
            'status' => 'pending'
        ],
        [
            'id' => 'REQ-9014',
            'title' => 'Split AC Compressor Not Cooling',
            'type' => 'request',
            'category' => 'AC Repair',
            'match_score' => '95% Match',
            'author' => 'Anoma Senanayake (Dehiwala)',
            'author_type' => 'user',
            'price_or_match' => '95% Match',
            'time' => '1h ago',
            'status' => 'pending'
        ],
    ];

    $_SESSION['wedalink_logs'] = [
        [
            'id' => 101,
            'action' => 'Admin approved provider Chaminda Silva (AC Tech - Negombo)',
            'detail' => 'Verification checklist complete (NVQ Cert validated)',
            'time' => '12m ago',
            'type' => 'approval'
        ],
        [
            'id' => 102,
            'action' => 'Admin removed duplicate listing #EQ-4091',
            'detail' => 'Flagged as redundant posting in Maharagama node',
            'time' => '45m ago',
            'type' => 'removal'
        ],
        [
            'id' => 103,
            'action' => 'Admin resolved flagged review #REV-88',
            'detail' => 'Mutual resolution recorded between customer & electrician',
            'time' => '2h ago',
            'type' => 'review'
        ],
    ];

    $_SESSION['wedalink_data_initialized'] = true;
}

/**
 * Get active pending providers count
 */
function getPendingProvidersCount(): int {
    $count = 0;
    foreach ($_SESSION['wedalink_providers'] as $p) {
        if ($p['status'] === 'pending') {
            $count++;
        }
    }
    return $count;
}

/**
 * Get counts grouped by category
 */
function getProviderCategoryCounts(): array {
    $counts = [
        'all' => 0,
        'Electrician' => 0,
        'Plumber' => 0,
        'AC Tech' => 0,
    ];
    foreach ($_SESSION['wedalink_providers'] as $p) {
        if ($p['status'] === 'pending') {
            $counts['all']++;
            if (isset($counts[$p['trade']])) {
                $counts[$p['trade']]++;
            }
        }
    }
    return $counts;
}

/**
 * Get pending moderation listings count
 */
function getPendingListingsCount(): int {
    $count = 0;
    foreach ($_SESSION['wedalink_listings'] as $item) {
        if ($item['status'] === 'pending') {
            $count++;
        }
    }
    return $count;
}
