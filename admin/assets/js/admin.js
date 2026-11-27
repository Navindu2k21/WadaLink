/**
 * WadaLink Admin Panel Core JavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
  // Category Filter Tabs
  const filterBtns = document.querySelectorAll('.filter-pill-btn');
  const providerCards = document.querySelectorAll('.provider-item-card');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      const filter = btn.getAttribute('data-filter');
      let visibleCount = 0;

      providerCards.forEach(card => {
        const trade = card.getAttribute('data-trade');
        if (filter === 'all' || trade === filter) {
          card.style.display = 'block';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      });
    });
  });

  // Live Search Input Filter
  const searchInput = document.querySelector('.search-input');
  if (searchInput) {
    searchInput.addEventListener('input', (e) => {
      const query = e.target.value.toLowerCase().trim();
      providerCards.forEach(card => {
        const text = card.textContent.toLowerCase();
        if (text.includes(query)) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  }

  // Auto-sync ticker simulation
  const syncSubtitle = document.querySelector('.sync-subtitle');
  let secondsAgo = 0;
  setInterval(() => {
    secondsAgo++;
    if (syncSubtitle) {
      if (secondsAgo < 5) {
        syncSubtitle.textContent = 'Last check: Just now';
      } else {
        syncSubtitle.textContent = `Last check: ${secondsAgo}s ago`;
      }
    }
  }, 1000);

  // Manual Refresh Button Click
  const syncBox = document.querySelector('.sync-status-box');
  if (syncBox) {
    syncBox.style.cursor = 'pointer';
    syncBox.title = 'Click to force sync';
    syncBox.addEventListener('click', () => {
      secondsAgo = 0;
      if (syncSubtitle) syncSubtitle.textContent = 'Last check: Just now';
      showToast('Synchronization complete with central dispatch stream.', 'success');
    });
  }

  // Daily Audit PDF Modal / Action
  const auditBtn = document.querySelector('#btn-daily-audit');
  const auditModal = document.querySelector('#audit-modal');
  const closeModalBtn = document.querySelector('.modal-close-btn');

  if (auditBtn && auditModal) {
    auditBtn.addEventListener('click', () => {
      auditModal.classList.add('active');
    });
  }

  if (closeModalBtn && auditModal) {
    closeModalBtn.addEventListener('click', () => {
      auditModal.classList.remove('active');
    });
  }

  window.addEventListener('click', (e) => {
    if (e.target === auditModal) {
      auditModal.classList.remove('active');
    }
  });
});

// Toast notification helper
function showToast(message, type = 'success') {
  const container = document.getElementById('toast-container');
  if (!container) return;

  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.innerHTML = `
    <span>${type === 'success' ? '✓' : '⚠️'}</span>
    <div>${message}</div>
  `;
  container.appendChild(toast);

  setTimeout(() => {
    toast.style.opacity = '0';
    toast.style.transform = 'translateY(10px)';
    toast.style.transition = 'all 0.3s ease';
    setTimeout(() => toast.remove(), 300);
  }, 3500);
}

// Approve Provider Action
async function approveProvider(providerId, providerName) {
  if (!confirm(`Are you sure you want to approve provider credentials for ${providerName}?`)) {
    return;
  }

  try {
    const response = await fetch(`api/actions.php?action=approve_provider&id=${providerId}`, {
      method: 'POST'
    });
    const result = await response.json();

    if (result.success) {
      showToast(`Provider "${providerName}" has been successfully approved!`, 'success');
      const card = document.getElementById(`provider-card-${providerId}`);
      if (card) {
        card.style.transition = 'all 0.35s ease';
        card.style.opacity = '0';
        card.style.transform = 'scale(0.96)';
        setTimeout(() => card.remove(), 350);
      }
      updateCounters();
      prependLog(`Admin approved provider ${providerName}`, 'Verification checklist complete (NVQ Cert validated)');
    } else {
      showToast(result.message || 'Action failed', 'error');
    }
  } catch (err) {
    showToast('Failed to connect to admin API', 'error');
  }
}

// Reject Provider Action
async function rejectProvider(providerId, providerName) {
  const reason = prompt(`Enter rejection reason for ${providerName}:`, 'Incomplete document verification / NIC mismatch');
  if (reason === null) return;

  try {
    const response = await fetch(`api/actions.php?action=reject_provider&id=${providerId}&reason=${encodeURIComponent(reason)}`, {
      method: 'POST'
    });
    const result = await response.json();

    if (result.success) {
      showToast(`Provider "${providerName}" application has been rejected.`, 'error');
      const card = document.getElementById(`provider-card-${providerId}`);
      if (card) {
        card.style.transition = 'all 0.35s ease';
        card.style.opacity = '0';
        card.style.transform = 'scale(0.96)';
        setTimeout(() => card.remove(), 350);
      }
      updateCounters();
      prependLog(`Admin rejected provider application for ${providerName}`, `Reason: ${reason}`);
    } else {
      showToast(result.message || 'Action failed', 'error');
    }
  } catch (err) {
    showToast('Failed to connect to admin API', 'error');
  }
}

// Approve Listing Action
async function approveListing(listingId, title) {
  try {
    const response = await fetch(`api/actions.php?action=approve_listing&id=${listingId}`, {
      method: 'POST'
    });
    const result = await response.json();

    if (result.success) {
      showToast(`Listing #${listingId} approved for public marketplace.`, 'success');
      const item = document.getElementById(`listing-item-${listingId}`);
      if (item) {
        item.style.transition = 'all 0.3s ease';
        item.style.opacity = '0';
        setTimeout(() => item.remove(), 300);
      }
      decrementQueueBadge();
      prependLog(`Admin approved listing #${listingId}`, title);
    }
  } catch (err) {
    showToast('Error approving listing', 'error');
  }
}

// Remove Listing Action
async function removeListing(listingId, title) {
  if (!confirm(`Remove listing #${listingId} from queue?`)) return;

  try {
    const response = await fetch(`api/actions.php?action=remove_listing&id=${listingId}`, {
      method: 'POST'
    });
    const result = await response.json();

    if (result.success) {
      showToast(`Listing #${listingId} removed from queue.`, 'error');
      const item = document.getElementById(`listing-item-${listingId}`);
      if (item) {
        item.style.transition = 'all 0.3s ease';
        item.style.opacity = '0';
        setTimeout(() => item.remove(), 300);
      }
      decrementQueueBadge();
      prependLog(`Admin removed duplicate listing #${listingId}`, 'Flagged during moderation queue review');
    }
  } catch (err) {
    showToast('Error removing listing', 'error');
  }
}

// Dynamic counter updates
function updateCounters() {
  const pendingStat = document.getElementById('stat-pending-approvals');
  const navBadge = document.getElementById('nav-pending-badge');
  const boxBadge = document.getElementById('box-pending-badge');

  let current = parseInt(pendingStat ? pendingStat.textContent : '5', 10);
  if (current > 0) current--;

  if (pendingStat) pendingStat.textContent = current;
  if (navBadge) navBadge.textContent = current;
  if (boxBadge) boxBadge.textContent = `${current} Pending`;
}

function decrementQueueBadge() {
  const queueBadge = document.getElementById('queue-count-badge');
  if (queueBadge) {
    let count = parseInt(queueBadge.textContent, 10);
    if (count > 0) count--;
    queueBadge.textContent = `${count} Queue`;
  }
}

function prependLog(actionText, subtext) {
  const container = document.getElementById('admin-logs-timeline');
  if (!container) return;

  const entry = document.createElement('div');
  entry.className = 'log-timeline-entry';
  entry.innerHTML = `
    <div class="log-dot-circle"></div>
    <div class="log-content-body">
      <div class="log-header-line">
        <span class="log-action-text">${actionText}</span>
        <span class="log-timestamp">Just now</span>
      </div>
      <div class="log-subtext">${subtext}</div>
    </div>
  `;
  container.insertBefore(entry, container.firstChild);
}

// Table Filtering and Search for Provider Approvals Page
function setupApprovalsTableFilters() {
  const tableSearchInput = document.getElementById('table-search-input');
  const categorySelect = document.getElementById('category-filter-select');
  const citySelect = document.getElementById('city-filter-select');
  const tableTabs = document.querySelectorAll('.table-tab-btn');
  const tableRows = document.querySelectorAll('#approvals-table-body tr');

  let activeTab = 'pending';

  function applyFilters() {
    const query = (tableSearchInput ? tableSearchInput.value : '').toLowerCase().trim();
    const category = categorySelect ? categorySelect.value : 'all';
    const city = citySelect ? citySelect.value : 'all';

    let matchCount = 0;

    tableRows.forEach(row => {
      const status = row.getAttribute('data-status');
      const rowCategory = row.getAttribute('data-category');
      const rowCity = row.getAttribute('data-city');
      const text = row.textContent.toLowerCase();

      const matchesTab = (activeTab === 'all') || (status === activeTab);
      const matchesCategory = (category === 'all') || (rowCategory === category);
      const matchesCity = (city === 'all') || (rowCity === city);
      const matchesQuery = (!query) || text.includes(query);

      if (matchesTab && matchesCategory && matchesCity && matchesQuery) {
        row.style.display = '';
        matchCount++;
      } else {
        row.style.display = 'none';
      }
    });

    const summaryText = document.getElementById('table-showing-summary');
    if (summaryText) {
      summaryText.textContent = `Showing 1 to ${matchCount} of 50 registered providers`;
    }
  }

  if (tableSearchInput) tableSearchInput.addEventListener('input', applyFilters);
  if (categorySelect) categorySelect.addEventListener('change', applyFilters);
  if (citySelect) citySelect.addEventListener('change', applyFilters);

  tableTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      tableTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      activeTab = tab.getAttribute('data-tab') || 'all';
      applyFilters();
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  setupApprovalsTableFilters();
});

// Suspend Provider Action
async function suspendProvider(providerId, providerName) {
  if (!confirm(`Are you sure you want to suspend provider account for ${providerName}?`)) return;

  try {
    const response = await fetch(`../api/actions.php?action=suspend_provider&id=${providerId}`, {
      method: 'POST'
    });
    const result = await response.json();

    if (result.success) {
      showToast(`Provider account for "${providerName}" has been suspended.`, 'error');
      const row = document.getElementById(`provider-row-${providerId}`);
      if (row) {
        const statusCell = row.querySelector('.table-status-pill');
        if (statusCell) {
          statusCell.className = 'table-status-pill pending';
          statusCell.innerHTML = '<span class="status-indicator-dot" style="background:#DC2626;"></span> Suspended';
        }
      }
    }
  } catch (err) {
    showToast('Failed to contact admin API', 'error');
  }
}

// Modal for Provider Full Credentials Inspection
function viewProviderModal(name, nic, trade, exp, phone, city, status) {
  const modal = document.getElementById('provider-detail-modal');
  if (!modal) return;

  document.getElementById('modal-provider-name').textContent = name;
  document.getElementById('modal-provider-nic').textContent = nic;
  document.getElementById('modal-provider-trade').textContent = trade;
  document.getElementById('modal-provider-exp').textContent = exp;
  document.getElementById('modal-provider-phone').textContent = phone;
  document.getElementById('modal-provider-city').textContent = city;
  document.getElementById('modal-provider-status').textContent = status;

  modal.classList.add('active');
}

// Service Requests Moderation Filters
function setupServiceRequestsFilters() {
  const searchInput = document.getElementById('service-search-input');
  const catSelect = document.getElementById('service-cat-select');
  const statusSelect = document.getElementById('service-status-select');
  const serviceTabs = document.querySelectorAll('.service-tab-pill');
  const rows = document.querySelectorAll('#service-requests-table-body tr');

  let activeTab = 'all';

  function applyServiceFilters() {
    const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
    const cat = catSelect ? catSelect.value : 'all';
    const status = statusSelect ? statusSelect.value : 'all';

    let count = 0;
    rows.forEach(row => {
      const rowStatus = row.getAttribute('data-status') || '';
      const rowCat = row.getAttribute('data-cat') || '';
      const isFlagged = row.getAttribute('data-flagged') === '1';
      const text = row.textContent.toLowerCase();

      let matchesTab = true;
      if (activeTab === 'ai') matchesTab = !isFlagged;
      else if (activeTab === 'flagged') matchesTab = isFlagged;
      else if (activeTab === 'review') matchesTab = (rowStatus === 'Open');

      const matchesCat = (cat === 'all') || (rowCat === cat);
      const matchesStatus = (status === 'all') || (rowStatus === status);
      const matchesQuery = (!query) || text.includes(query);

      if (matchesTab && matchesCat && matchesStatus && matchesQuery) {
        row.style.display = '';
        count++;
      } else {
        row.style.display = 'none';
      }
    });

    const summary = document.getElementById('service-summary-text');
    if (summary) {
      summary.textContent = `Showing 1 - ${count} of 36 customer service requests across Sri Lanka`;
    }
  }

  if (searchInput) searchInput.addEventListener('input', applyServiceFilters);
  if (catSelect) catSelect.addEventListener('change', applyServiceFilters);
  if (statusSelect) statusSelect.addEventListener('change', applyServiceFilters);

  serviceTabs.forEach(tab => {
    tab.addEventListener('click', () => {
      serviceTabs.forEach(t => t.classList.remove('active'));
      tab.classList.add('active');
      activeTab = tab.getAttribute('data-tab') || 'all';
      applyServiceFilters();
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  setupServiceRequestsFilters();
});

// Reassign Category
function reassignRequest(reqId, currentCat) {
  const newCat = prompt(`Reassign Category for #${reqId} (Current: ${currentCat}):\nOptions: Plumbing, AC Repair, Electrical, Carpentry, Masonry`, currentCat);
  if (!newCat || newCat === currentCat) return;

  const row = document.getElementById(`service-row-${reqId}`);
  if (row) {
    const badge = row.querySelector('.ai-category-badge');
    if (badge) {
      badge.textContent = newCat;
      showToast(`Request #${reqId} reassigned to "${newCat}". Manual override logged.`, 'success');
      prependLog(`Admin reassigned request #${reqId}`, `Category changed from ${currentCat} to ${newCat}`);
    }
  }
}

// Delete / Trash Request
function deleteRequestRow(reqId) {
  if (!confirm(`Are you sure you want to remove request #${reqId} from active queue?`)) return;

  const row = document.getElementById(`service-row-${reqId}`);
  if (row) {
    row.style.transition = 'all 0.3s ease';
    row.style.opacity = '0';
    setTimeout(() => row.remove(), 300);
    showToast(`Request #${reqId} deleted from moderation queue.`, 'error');
    prependLog(`Admin deleted request #${reqId}`, 'Manual moderation purge');
  }
}

// Inspect Request Modal
function inspectRequestModal(reqId, title, customer, category, confidence, urgency) {
  const modal = document.getElementById('request-detail-modal');
  if (!modal) return;

  document.getElementById('modal-req-id').textContent = reqId;
  document.getElementById('modal-req-title').textContent = title;
  document.getElementById('modal-req-customer').textContent = customer;
  document.getElementById('modal-req-category').textContent = category;
  document.getElementById('modal-req-confidence').textContent = confidence;
  document.getElementById('modal-req-urgency').textContent = urgency;

  modal.classList.add('active');
}


