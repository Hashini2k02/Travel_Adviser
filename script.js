/* =====================================================
   TRAVEL ADVISER – Custom JavaScript
   Features: Navbar scroll, Search filter, Form validation, Newsletter
===================================================== */

/* ──────────────────────────────────────────────────
   1. NAVBAR: Add "scrolled" class on scroll
────────────────────────────────────────────────── */
const navbar = document.getElementById('mainNavbar');

window.addEventListener('scroll', function () {
  if (window.scrollY > 60) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

/* ──────────────────────────────────────────────────
   2. ACTIVE NAV LINK: Highlight based on scroll
────────────────────────────────────────────────── */
const sections   = document.querySelectorAll('section[id]');
const navLinks   = document.querySelectorAll('.nav-link-custom');

function setActiveNav() {
  let scrollPos = window.scrollY + 100;

  sections.forEach(section => {
    const top    = section.offsetTop;
    const height = section.offsetHeight;
    const id     = section.getAttribute('id');

    if (scrollPos >= top && scrollPos < top + height) {
      navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === '#' + id) {
          link.classList.add('active');
        }
      });
    }
  });
}

window.addEventListener('scroll', setActiveNav);
window.addEventListener('load',   setActiveNav);

/* ──────────────────────────────────────────────────
   3. SEARCH FILTER: Filter destination cards
────────────────────────────────────────────────── */
const searchInput = document.getElementById('searchInput');

// Trigger search on Enter key in the search box
searchInput.addEventListener('keyup', function (e) {
  if (e.key === 'Enter') {
    filterDestinations();
  }
});

// Live filter as user types (optional UX enhancement)
searchInput.addEventListener('input', function () {
  filterDestinations();
});

/**
 * filterDestinations()
 * Reads the search input value, then shows/hides
 * destination cards based on the data-name attribute.
 */
function filterDestinations() {
  const query   = searchInput.value.trim().toLowerCase();
  const cards   = document.querySelectorAll('.dest-card-col');
  const noRes   = document.getElementById('noResults');

  let visibleCount = 0;

  cards.forEach(function (col) {
    const keywords = col.getAttribute('data-name').toLowerCase();

    if (query === '' || keywords.includes(query)) {
      col.classList.remove('d-none-filter');
      col.classList.add('fade-in-card');
      visibleCount++;
    } else {
      col.classList.add('d-none-filter');
      col.classList.remove('fade-in-card');
    }
  });

  // Show or hide the "no results" message
  if (visibleCount === 0 && query !== '') {
    noRes.classList.remove('d-none');
  } else {
    noRes.classList.add('d-none');
  }

  // Scroll to destinations section
  if (query !== '') {
    const destSection = document.getElementById('destinations');
    if (destSection) {
      destSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }
}

/**
 * clearSearch()
 * Resets the search input and shows all destinations.
 */
function clearSearch() {
  searchInput.value = '';
  filterDestinations();
}

/* ──────────────────────────────────────────────────
   4. CONTACT FORM VALIDATION
────────────────────────────────────────────────── */
const contactForm = document.getElementById('contactForm');
const formSuccess = document.getElementById('formSuccess');

contactForm.addEventListener('submit', function (e) {
  e.preventDefault();  // Prevent default form submission

  let isValid = true;

  // Clear previous validation states
  const inputs = contactForm.querySelectorAll('.form-input');
  inputs.forEach(input => {
    input.classList.remove('is-invalid', 'is-valid');
  });

  /* ── Validate Full Name ── */
  const nameField = document.getElementById('fullName');
  if (!nameField.value.trim() || nameField.value.trim().length < 3) {
    setInvalid(nameField);
    isValid = false;
  } else {
    setValid(nameField);
  }

  /* ── Validate Email ── */
  const emailField  = document.getElementById('emailAddr');
  const emailRegex  = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailField.value.trim() || !emailRegex.test(emailField.value.trim())) {
    setInvalid(emailField);
    isValid = false;
  } else {
    setValid(emailField);
  }

  /* ── Validate Destination ── */
  const destField = document.getElementById('destination');
  if (!destField.value) {
    setInvalid(destField);
    isValid = false;
  } else {
    setValid(destField);
  }

  /* ── Validate Travel Date ── */
  const dateField = document.getElementById('travelDate');
  if (!dateField.value) {
    setInvalid(dateField);
    isValid = false;
  } else {
    // Ensure date is not in the past
    const selectedDate = new Date(dateField.value);
    const today        = new Date();
    today.setHours(0, 0, 0, 0);
    if (selectedDate < today) {
      setInvalid(dateField);
      // Update the error message dynamically
      const feedback = dateField.parentElement.querySelector('.invalid-feedback');
      if (feedback) feedback.textContent = 'Travel date must be today or in the future.';
      isValid = false;
    } else {
      setValid(dateField);
    }
  }

  /* ── Validate Message ── */
  const msgField = document.getElementById('message');
  if (!msgField.value.trim() || msgField.value.trim().length < 10) {
    setInvalid(msgField);
    isValid = false;
  } else {
    setValid(msgField);
  }

  /* ── If All Valid: Show success & reset ── */
  if (isValid) {
    formSuccess.classList.remove('d-none');
    formSuccess.classList.add('d-flex');

    // Disable submit button to prevent double submission
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled  = true;
    submitBtn.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>Message Sent!';
    submitBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';

    // Reset form after 3 seconds
    setTimeout(function () {
      contactForm.reset();
      inputs.forEach(input => input.classList.remove('is-valid', 'is-invalid'));
      formSuccess.classList.add('d-none');
      formSuccess.classList.remove('d-flex');
      submitBtn.disabled  = false;
      submitBtn.innerHTML = '<i class="bi bi-send-fill me-2"></i>Send Message';
      submitBtn.style.background = '';
    }, 3500);
  }
});

/** Helper: mark field as invalid */
function setInvalid(field) {
  field.classList.add('is-invalid');
  field.classList.remove('is-valid');
}

/** Helper: mark field as valid */
function setValid(field) {
  field.classList.add('is-valid');
  field.classList.remove('is-invalid');
}

/* ──────────────────────────────────────────────────
   5. NEWSLETTER SUBSCRIPTION
────────────────────────────────────────────────── */
function subscribeNewsletter() {
  const emailInput = document.getElementById('newsletterEmail');
  const msgDiv     = document.getElementById('newsletterMsg');
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  if (!emailInput.value.trim() || !emailRegex.test(emailInput.value.trim())) {
    msgDiv.textContent  = '⚠ Please enter a valid email address.';
    msgDiv.className    = 'mt-2 small text-warning d-block';
    emailInput.style.borderColor = '#f59e0b';
    return;
  }

  // Success
  msgDiv.innerHTML   = '✅ Subscribed successfully! Welcome aboard.';
  msgDiv.className   = 'mt-2 small text-success d-block';
  emailInput.value   = '';
  emailInput.style.borderColor = '';

  // Hide message after 3 seconds
  setTimeout(function () {
    msgDiv.textContent = '';
    msgDiv.className   = 'mt-2 small d-none';
  }, 3500);
}

/* ──────────────────────────────────────────────────
   6. SMOOTH SCROLL for all anchor links
────────────────────────────────────────────────── */
document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
  anchor.addEventListener('click', function (e) {
    const target = document.querySelector(this.getAttribute('href'));
    if (target) {
      e.preventDefault();
      // Close mobile navbar if open
      const navCollapse = document.getElementById('navbarNav');
      if (navCollapse && navCollapse.classList.contains('show')) {
        const bsCollapse = bootstrap.Collapse.getInstance(navCollapse);
        if (bsCollapse) bsCollapse.hide();
      }
      target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  });
});
