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
            'initials' => 'KP',
            'initials_color' => 'blue',
            'name' => 'Kasun Perera',
            'nic' => '198923401928',
            'trade' => 'Electrician',
            'specialization' => 'Domestic wiring & 3-phase boards',
            'location' => 'Colombo 07',
            'city' => 'Colombo',
            'province' => 'Western Province',
            'phone' => '+94 77 123 4567',
            'experience' => '8 Years',
            'registered_day' => 'Today',
            'registered_time' => '09:30 AM',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'status' => 'pending'
        ],
        [
            'id' => 2,
            'initials' => 'NF',
            'initials_color' => 'teal',
            'name' => 'Nimal Fernando',
            'nic' => '199219204910',
            'trade' => 'Plumber',
            'specialization' => 'High-pressure pipe fitting & pumps',
            'location' => 'Kandy Central',
            'city' => 'Kandy',
            'province' => 'Central Province',
            'phone' => '+94 71 890 1234',
            'experience' => '6 Years',
            'registered_day' => 'Today',
            'registered_time' => '08:15 AM',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'status' => 'pending'
        ],
        [
            'id' => 3,
            'initials' => 'RJ',
            'initials_color' => 'cyan',
            'name' => 'Ruwan Jayasinghe',
            'nic' => '199581902844',
            'trade' => 'AC Technician',
            'specialization' => 'Inverter AC diagnostics & gas recharge',
            'location' => 'Kurunegala',
            'city' => 'Kurunegala',
            'province' => 'North Western',
            'phone' => '+94 76 543 2109',
            'experience' => '5 Years',
            'registered_day' => 'Yesterday',
            'registered_time' => '04:45 PM',
            'nic_status' => 'Police Clearance Pending',
            'nic_verified' => false,
            'police_clearance' => 'Pending',
            'status' => 'pending'
        ],
        [
            'id' => 4,
            'initials' => 'DB',
            'initials_color' => 'blue',
            'name' => 'Dinesh Bandara',
            'nic' => '198308101238',
            'trade' => 'Electrician',
            'specialization' => 'Generator sync & solar inverters',
            'location' => 'Gampaha',
            'city' => 'Gampaha',
            'province' => 'Western Province',
            'phone' => '+94 70 234 5678',
            'experience' => '10 Years',
            'registered_day' => 'Yesterday',
            'registered_time' => '01:20 PM',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'status' => 'pending'
        ],
        [
            'id' => 5,
            'initials' => 'CS',
            'initials_color' => 'gray',
            'name' => 'Chaminda Silva',
            'nic' => '198811409212',
            'trade' => 'AC Technician',
            'specialization' => 'Commercial Chiller Repair',
            'location' => 'Negombo',
            'city' => 'Negombo',
            'province' => 'Western Province',
            'phone' => '+94 71 345 6789',
            'experience' => '7 Years',
            'registered_day' => '2 days ago',
            'registered_time' => '11:00 AM',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'status' => 'approved'
        ],
        [
            'id' => 6,
            'initials' => 'SK',
            'initials_color' => 'slate',
            'name' => 'Sunil Karunaratne',
            'nic' => '197829481901',
            'trade' => 'Carpenter & Woodworker',
            'specialization' => 'Custom Teak Roofing & Joinery',
            'location' => 'Moratuwa',
            'city' => 'Moratuwa',
            'province' => 'Western Province',
            'phone' => '+94 77 654 3210',
            'experience' => '12 Years',
            'registered_day' => '3 days ago',
            'registered_time' => '02:40 PM',
            'nic_status' => 'Verified Doc',
            'nic_verified' => true,
            'police_clearance' => 'Approved',
            'status' => 'approved'
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

    $_SESSION['wedalink_service_requests'] = [
        [
            'id' => 'SR-1042',
            'time_ago' => '14 mins ago',
            'customer_name' => 'Malik Samarakoon',
            'customer_sub' => 'NIC Verified',
            'customer_initials' => 'MS',
            'customer_color' => 'blue',
            'title' => 'Emergency water leak in main bathroom ceiling pipe, water dripping',
            'badges' => [
                ['text' => '2 Photos Attached', 'type' => 'media'],
                ['text' => 'Requires Licensed Plumber', 'type' => 'specialist']
            ],
            'category' => 'Plumbing',
            'confidence' => '98%',
            'confidence_status' => 'Verified',
            'city' => 'Battaramulla',
            'district' => 'Colombo District',
            'urgency' => 'High',
            'status' => 'Open',
            'is_flagged' => false
        ],
        [
            'id' => 'SR-1041',
            'time_ago' => '32 mins ago',
            'customer_name' => 'Anoma Senanayake',
            'customer_sub' => 'Regular Homeowner',
            'customer_initials' => 'AS',
            'customer_color' => 'teal',
            'title' => 'Master bedroom inverter split AC blowing warm air, outdoor unit fan...',
            'badges' => [
                ['text' => 'Voice Note (Sinhala) Transcribed', 'type' => 'voice']
            ],
            'category' => 'AC Repair',
            'confidence' => '95%',
            'confidence_status' => 'Matched',
            'city' => 'Dehiwala',
            'district' => 'Colombo South',
            'urgency' => 'Normal',
            'status' => 'Open',
            'is_flagged' => false
        ],
        [
            'id' => 'SR-1040',
            'time_ago' => '1 hr ago',
            'customer_name' => 'Gayan Wickramasinghe',
            'customer_sub' => 'Phone Verified',
            'customer_initials' => 'GW',
            'customer_color' => 'cyan',
            'title' => 'Main circuit breaker trips whenever electric oven and water heater run...',
            'badges' => [
                ['text' => 'Electrical Hazard Flag', 'type' => 'danger'],
                ['text' => 'Dispatching Local Certified Wireman', 'type' => 'specialist']
            ],
            'category' => 'Electrical',
            'confidence' => '97%',
            'confidence_status' => 'Confirmed',
            'city' => 'Kandy Town',
            'district' => 'Central Province',
            'urgency' => 'High',
            'status' => 'In Progress',
            'is_flagged' => false
        ],
        [
            'id' => 'SR-1039',
            'time_ago' => '3 hrs ago',
            'customer_name' => 'Dilani Perera',
            'customer_sub' => 'Maharagama Resident',
            'customer_initials' => 'DP',
            'customer_color' => 'slate',
            'title' => 'Custom wooden pantry cupboard hinge replacement and alignment in',
            'badges' => [
                ['text' => 'Job Fulfilled by Sri Lankan Craftsman', 'type' => 'info']
            ],
            'category' => 'Carpentry',
            'confidence' => '92%',
            'confidence_status' => 'High',
            'city' => 'Maharagama',
            'district' => 'Western Province',
            'urgency' => 'Low',
            'status' => 'Completed',
            'is_flagged' => false
        ],
        [
            'id' => 'SR-1038',
            'time_ago' => '5 hrs ago',
            'customer_name' => 'Flagged Request',
            'customer_sub' => 'Reported by 2 providers',
            'customer_initials' => '!',
            'customer_color' => 'red',
            'title' => 'Suspected duplicate commercial demolition post with spam contact...',
            'badges' => [
                ['text' => 'Automated Security Filter & Community Flags Triggered', 'type' => 'security_alert']
            ],
            'category' => 'Masonry',
            'confidence' => '61%',
            'confidence_status' => 'Low match score',
            'city' => 'Negombo',
            'district' => 'Gampaha District',
            'urgency' => 'High',
            'status' => 'Flagged',
            'is_flagged' => true
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
