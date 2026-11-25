<?php
/**
 * WedaLink Control Center - Overview & Operations Stats
 * Main PHP Admin Panel Dashboard
 */
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

$currentPage = 'overview';
$pendingCount = getPendingProvidersCount();
$categoryCounts = getProviderCategoryCounts();
$pendingListingsCount = getPendingListingsCount();

require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/includes/sidebar.php';
?>

<div class="main-wrapper">
  <?php require_once __DIR__ . '/includes/topbar.php'; ?>

  <main class="page-content">
    <!-- Header Section -->
    <div class="page-header-row">
      <div class="header-title-group">
        <div class="header-meta-stream">
          <span class="stream-square"></span>
          <span>NATIONAL DISPATCH STREAM <?= htmlspecialchars(APP_TIMEZONE) ?> &bull; ISLAND-WIDE</span>
        </div>
        <h1>Overview &amp; Operations Stats</h1>
        <p>Real-time summary of provider verification, marketplace listings, and platform moderation activity across Western, Central, and North Western provinces in Sri Lanka.</p>
      </div>

      <div class="header-right-actions">
        <!-- Auto-sync Status Indicator -->
        <div class="sync-status-box" title="Island-wide Dispatch Stream Active">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="23 4 23 10 17 10"></polyline>
            <polyline points="1 20 1 14 7 14"></polyline>
            <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"></path>
          </svg>
          <div class="sync-text-group">
            <span class="sync-title">Auto-sync 30s</span>
            <span class="sync-subtitle">Last check: Just now</span>
          </div>
        </div>

        <!-- Daily Audit PDF Button -->
        <button class="btn-primary-action" id="btn-daily-audit">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
          </svg>
          <span>Daily Audit PDF</span>
        </button>
      </div>
    </div>

    <!-- Top 4 Metric Cards Grid -->
    <section class="metric-cards-grid">
      <!-- Card 1: Pending Provider Approvals -->
      <article class="metric-card">
        <div class="metric-card-top">
          <div class="metric-icon-square red">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <rect x="2" y="7" width="20" height="14" rx="2" ry="2"></rect>
              <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"></path>
            </svg>
          </div>
          <span class="metric-status-badge red">Action Needed</span>
        </div>
        <div class="metric-value" id="stat-pending-approvals"><?= $pendingCount ?></div>
        <div class="metric-title">Pending Provider Approvals</div>
        <div class="metric-subtext"><?= $pendingCount ?> applicants awaiting credential check</div>
      </article>

      <!-- Card 2: Active Service Jobs -->
      <article class="metric-card">
        <div class="metric-card-top">
          <div class="metric-icon-square teal">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
              <circle cx="9" cy="7" r="4"></circle>
              <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
              <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
            </svg>
          </div>
          <span class="metric-status-badge green">Active</span>
        </div>
        <div class="metric-value"><?= $_SESSION['wedalink_stats']['active_jobs'] ?? 28 ?></div>
        <div class="metric-title">Active Service Jobs</div>
        <div class="metric-subtext">Electricians, Plumbers, AC Technicians</div>
      </article>

      <!-- Card 3: Active Equipment Rentals -->
      <article class="metric-card">
        <div class="metric-card-top">
          <div class="metric-icon-square blue">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path>
            </svg>
          </div>
          <span class="metric-status-badge gray">In Circulation</span>
        </div>
        <div class="metric-value"><?= $_SESSION['wedalink_stats']['active_equipment'] ?? 14 ?></div>
        <div class="metric-title">Active Equipment Rentals</div>
        <div class="metric-subtext">Available / Reserved / Returned</div>
      </article>

      <!-- Card 4: Flagged Reviews & Chats -->
      <article class="metric-card">
        <div class="metric-card-top">
          <div class="metric-icon-square orange">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
              <line x1="9" y1="10" x2="15" y2="10"></line>
            </svg>
          </div>
          <span class="metric-status-badge red">Review Required</span>
        </div>
        <div class="metric-value"><?= $_SESSION['wedalink_stats']['flagged_reviews'] ?? 2 ?></div>
        <div class="metric-title">Flagged Reviews &amp; Chats</div>
        <div class="metric-subtext">Reported user issues needing arbitration</div>
      </article>
    </section>

    <!-- Two-Column Main Operations Grid -->
    <div class="dashboard-main-grid">
      <!-- LEFT COLUMN: Pending Provider Applications -->
      <section class="content-box">
        <div class="content-box-header">
          <h2 class="box-title">Pending Provider Applications</h2>

          <div class="box-header-filters">
            <span class="pending-tag-badge" id="box-pending-badge"><?= $pendingCount ?> Pending</span>
            <div class="filter-pills-row">
              <button class="filter-pill-btn active" data-filter="all">All (<?= $pendingCount ?>)</button>
              <button class="filter-pill-btn" data-filter="Electrician">Electrician (<?= $categoryCounts['Electrician'] ?? 2 ?>)</button>
              <button class="filter-pill-btn" data-filter="Plumber">Plumber (<?= $categoryCounts['Plumber'] ?? 2 ?>)</button>
              <button class="filter-pill-btn" data-filter="AC Tech">AC Tech (<?= $categoryCounts['AC Tech'] ?? 1 ?>)</button>
            </div>
          </div>
        </div>

        <div class="providers-list" id="providers-list-container">
          <?php foreach ($_SESSION['wedalink_providers'] as $p): ?>
            <?php if ($p['status'] !== 'pending') continue; ?>
            <div 
              class="provider-item-card" 
              id="provider-card-<?= $p['id'] ?>"
              data-trade="<?= htmlspecialchars($p['trade']) ?>"
            >
              <div class="provider-card-header">
                <div class="provider-identity-group">
                  <img 
                    src="<?= htmlspecialchars($p['avatar']) ?>" 
                    alt="<?= htmlspecialchars($p['name']) ?>" 
                    class="provider-avatar"
                  >
                  <div>
                    <div class="provider-name-row">
                      <span class="provider-name"><?= htmlspecialchars($p['name']) ?></span>
                      <?php if ($p['nic_verified']): ?>
                        <!-- Blue verified checkmark icon -->
                        <svg class="verified-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                          <path d="m9 12 2 2 4-4"></path>
                        </svg>
                      <?php else: ?>
                        <!-- Pending verification circle -->
                        <svg class="pending-shield-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <circle cx="12" cy="12" r="10"></circle>
                          <line x1="8" y1="12" x2="16" y2="12"></line>
                        </svg>
                      <?php endif; ?>
                    </div>
                    <div class="provider-meta-row">
                      <?= htmlspecialchars($p['trade']) ?> &bull; <?= htmlspecialchars($p['location']) ?>
                    </div>
                  </div>
                </div>

                <div class="provider-time-col">
                  <span class="time-label">Registered</span>
                  <span class="time-value"><?= htmlspecialchars($p['registered_time']) ?></span>
                </div>
              </div>

              <!-- Metadata Grid -->
              <div class="provider-details-grid">
                <div class="detail-item-col">
                  <span class="detail-key">Phone Contact</span>
                  <span class="detail-val"><?= htmlspecialchars($p['phone']) ?></span>
                </div>
                <div class="detail-item-col">
                  <span class="detail-key">Field Experience</span>
                  <span class="detail-val"><?= htmlspecialchars($p['experience']) ?></span>
                </div>
                <div class="detail-item-col">
                  <span class="detail-key">NIC Status</span>
                  <span class="detail-val">
                    <?php if ($p['nic_verified']): ?>
                      <span class="status-check-doc">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;">
                          <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                        Verified Doc
                      </span>
                    <?php else: ?>
                      <span class="status-pending-doc">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;">
                          <circle cx="12" cy="12" r="10"></circle>
                          <polyline points="12 6 12 12 14 14"></polyline>
                        </svg>
                        Police Clearance Pending
                      </span>
                    <?php endif; ?>
                  </span>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="provider-actions-row">
                <button 
                  type="button" 
                  class="btn-reject-action" 
                  onclick="rejectProvider(<?= $p['id'] ?>, '<?= addslashes($p['name']) ?>')"
                >
                  <span>&times;</span>
                  <span>Reject</span>
                </button>
                <button 
                  type="button" 
                  class="btn-approve-action" 
                  onclick="approveProvider(<?= $p['id'] ?>, '<?= addslashes($p['name']) ?>')"
                >
                  <span>&check;</span>
                  <span>Approve Provider</span>
                </button>
              </div>
            </div>
          <?php endforeach; ?>
        </div>

        <div class="view-all-link-row">
          <a href="pages/provider-approvals.php" class="view-all-link">
            <span>View all <?= $pendingCount ?> pending applications &rarr;</span>
          </a>
        </div>
      </section>

      <!-- RIGHT COLUMN: Moderation, Logs, and Provincial Dispatch -->
      <aside class="right-stack-column">
        <!-- Box 1: Recent Listings Awaiting Moderation -->
        <!-- <section class="content-box">
          <div class="content-box-header">
            <div class="box-title-area">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="4"></circle>
                <path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path>
              </svg>
              <h3 class="box-title" style="font-size: 15px;">Recent Listings Awaiting Moderation</h3>
            </div>
            <span class="queue-badge" id="queue-count-badge"><?= $pendingListingsCount ?> Queue</span>
          </div>

          <div class="moderation-items-list">
            <?php foreach ($_SESSION['wedalink_listings'] as $item): ?>
              <?php if ($item['status'] !== 'pending') continue; ?>
              <article class="moderation-item" id="listing-item-<?= htmlspecialchars($item['id']) ?>">
                <div class="moderation-item-top">
                  <h4 class="moderation-item-title"><?= htmlspecialchars($item['title']) ?></h4>
                  <span class="moderation-item-tag"><?= htmlspecialchars($item['category']) ?> &bull; <?= htmlspecialchars($item['price_or_match']) ?></span>
                </div>
                <div class="moderation-meta-row">
                  <span class="moderation-author">
                    <?php if ($item['author_type'] === 'business'): ?>
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 13px; height: 13px;">
                        <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                        <path d="M9 22v-4h6v4"></path>
                        <path d="M8 6h.01"></path>
                        <path d="M16 6h.01"></path>
                        <path d="M12 6h.01"></path>
                        <path d="M12 10h.01"></path>
                        <path d="M12 14h.01"></path>
                        <path d="M16 10h.01"></path>
                        <path d="M16 14h.01"></path>
                        <path d="M8 10h.01"></path>
                        <path d="M8 14h.01"></path>
                      </svg>
                    <?php else: ?>
                      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 13px; height: 13px;">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                      </svg>
                    <?php endif; ?>
                    <span><?= htmlspecialchars($item['author']) ?></span>
                  </span>
                  <span class="moderation-id">ID: #<?= htmlspecialchars($item['id']) ?></span>
                </div>
                <div class="moderation-action-row">
                  <button 
                    type="button" 
                    class="btn-remove-link"
                    onclick="removeListing('<?= htmlspecialchars($item['id']) ?>', '<?= addslashes($item['title']) ?>')"
                  >
                    Remove Listing
                  </button>
                  <button 
                    type="button" 
                    class="btn-approve-pill"
                    onclick="approveListing('<?= htmlspecialchars($item['id']) ?>', '<?= addslashes($item['title']) ?>')"
                  >
                    Approve
                  </button>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </section> -->

        <!-- Box 2: Recent Admin Logs Feed -->
        <section class="content-box">
          <div class="content-box-header">
            <div class="box-title-area">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 6 12 12 16 14"></polyline>
              </svg>
              <h3 class="box-title" style="font-size: 15px;">Recent Admin Logs Feed</h3>
            </div>
            <span class="live-badge">Live SLST</span>
          </div>

          <div class="admin-logs-timeline" id="admin-logs-timeline">
            <?php foreach (array_slice($_SESSION['wedalink_logs'], 0, 3) as $log): ?>
              <div class="log-timeline-entry">
                <div class="log-dot-circle"></div>
                <div class="log-content-body">
                  <div class="log-header-line">
                    <span class="log-action-text"><?= htmlspecialchars($log['action']) ?></span>
                    <span class="log-timestamp"><?= htmlspecialchars($log['time']) ?></span>
                  </div>
                  <div class="log-subtext"><?= htmlspecialchars($log['detail']) ?></div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="logs-footer-row">
            <span class="ledger-text">System Activity Ledger</span>
            <a href="pages/activity-logs.php" class="full-report-link">Full Log Report</a>
          </div>
        </section>

        <!-- Box 3: Sri Lanka Provincial Dispatch -->
        <section class="content-box">
          <div class="content-box-header" style="margin-bottom: 8px;">
            <div class="box-title-area">
              <h3 class="box-title" style="font-size: 15px;">Sri Lanka Provincial Dispatch</h3>
            </div>
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 17px; height: 17px; color: var(--muted-text);">
              <polygon points="1 6 1 22 8 18 16 22 23 18 23 2 16 6 8 2 1 6"></polygon>
              <line x1="8" y1="2" x2="8" y2="18"></line>
              <line x1="16" y1="6" x2="16" y2="22"></line>
            </svg>
          </div>

          <p class="dispatch-subtitle">Active field services concentrated in Western (Colombo, Gampaha) &amp; Central (Kandy) districts.</p>

          <div class="provincial-stats-row">
            <div class="provincial-stat-box">
              <div class="provincial-count"><?= $_SESSION['wedalink_provinces']['Western'] ?? 19 ?></div>
              <div class="provincial-name">Western</div>
            </div>
            <div class="provincial-stat-box">
              <div class="provincial-count"><?= $_SESSION['wedalink_provinces']['Central'] ?? 6 ?></div>
              <div class="provincial-name">Central</div>
            </div>
            <div class="provincial-stat-box">
              <div class="provincial-count"><?= $_SESSION['wedalink_provinces']['North Western'] ?? 3 ?></div>
              <div class="provincial-name">North Western</div>
            </div>
          </div>
        </section>
      </aside>
    </div>
  </main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
