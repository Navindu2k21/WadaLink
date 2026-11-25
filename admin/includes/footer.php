<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
?>
  </div><!-- .main-wrapper -->
</div><!-- .admin-shell -->

<!-- Toast Notification Container -->
<div class="toast-container" id="toast-container"></div>

<!-- Daily Audit PDF Modal -->
<div class="modal-overlay" id="audit-modal">
  <div class="modal-card">
    <div class="modal-header">
      <h3 class="modal-title">Daily Platform Audit &bull; <?= date('d M Y') ?></h3>
      <button class="modal-close-btn">&times;</button>
    </div>
    <div class="modal-body">
      <p style="margin-bottom: 12px;"><strong>National Dispatch &amp; Operations Stream Summary</strong></p>
      <p style="margin-bottom: 16px; color: var(--secondary-text);">
        System generated audit record for island-wide service requests, technician verifications, and marketplace listing moderation across Western, Central, and North Western provinces in Sri Lanka.
      </p>
      <div style="background: #F8FAFC; border: 1px solid var(--border-color); border-radius: 8px; padding: 14px; margin-bottom: 16px;">
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; font-size: 13px;">
          <div>&bull; <strong>Pending Credentials:</strong> <?= getPendingProvidersCount() ?> applicants</div>
          <div>&bull; <strong>Active Service Jobs:</strong> <?= $_SESSION['wedalink_stats']['active_jobs'] ?? 28 ?> in progress</div>
          <div>&bull; <strong>Equipment In Circulation:</strong> <?= $_SESSION['wedalink_stats']['active_equipment'] ?? 14 ?> units</div>
          <div>&bull; <strong>Flagged Arbitrations:</strong> <?= $_SESSION['wedalink_stats']['flagged_reviews'] ?? 2 ?> tickets</div>
        </div>
      </div>
      <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 18px;">
        <button class="filter-pill-btn" onclick="window.print();" style="padding: 8px 16px; border: 1px solid var(--border-color);">Print Report</button>
        <button class="btn-primary-action" onclick="showToast('Exporting Daily Audit PDF...', 'success'); document.getElementById('audit-modal').classList.remove('active');">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 15px; height: 15px;">
            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
            <polyline points="7 10 12 15 17 10"></polyline>
            <line x1="12" y1="15" x2="12" y2="3"></line>
          </svg>
          <span>Download Signed PDF</span>
        </button>
      </div>
    </div>
  </div>
</div>

<script src="assets/js/admin.js"></script>
</body>
</html>
