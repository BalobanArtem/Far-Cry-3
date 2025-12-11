document.addEventListener("DOMContentLoaded", () => {
  // Dom елементи
  const clockElement = document.getElementById("digitalClock");
  const countdownElement = document.getElementById("countdown");
  const modal = document.getElementById("registerModal");
  const form = document.getElementById("registerForm");
  const msg = document.getElementById("formMessage");
  const successNotification = document.getElementById("successNotification");

  // Годинник
  function updateClock() {
    if (!clockElement) return;
    const now = new Date();
    const hours = String(now.getHours()).padStart(2, "0");
    const minutes = String(now.getMinutes()).padStart(2, "0");
    const seconds = String(now.getSeconds()).padStart(2, "0");

    clockElement.innerHTML = `
      <span class="clock-part">${hours}</span>:
      <span class="clock-part">${minutes}</span>:
      <span class="clock-part">${seconds}</span>
    `;
  }

  // Таймер
  function updateCountdown() {
    if (!countdownElement) return;

    const targetDate = new Date("2026-03-21T00:00:00").getTime();
    const now = Date.now();
    const distance = targetDate - now;

    if (distance < 0) {
      countdownElement.innerHTML = `<span style="font-size:20px;color:#c75e54;">🔥 РЕЛІЗ ВЖЕ ВІДБУВСЯ! 🔥</span>`;
      clearInterval(countdownInterval);
      return;
    }

    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance / (1000 * 60 * 60)) % 24);
    const minutes = Math.floor((distance / (1000 * 60)) % 60);
    const seconds = Math.floor((distance / 1000) % 60);

    countdownElement.innerHTML = `
      <span class="timer-part days">${String(days).padStart(2, "0")}</span>Д 
      <span class="timer-part hours">${String(hours).padStart(2, "0")}</span>Г 
      <span class="timer-part minutes">${String(minutes).padStart(
        2,
        "0"
      )}</span>ХВ 
      <span class="timer-part seconds">${String(seconds).padStart(
        2,
        "0"
      )}</span>С
    `;
  }

  updateClock();
  updateCountdown();
  const clockInterval = setInterval(updateClock, 1000);
  const countdownInterval = setInterval(updateCountdown, 1000);

  // Модальне вікно реєстрації
  if (form && modal) {
    const openBtn = document.querySelector(".btn-register");
    const closeBtn = document.getElementById("closeModal");

    openBtn?.addEventListener("click", () => modal.classList.add("active"));
    closeBtn?.addEventListener("click", closeModal);

    modal.addEventListener("click", (e) => {
      if (e.target === modal) closeModal();
    });

    function closeModal() {
      modal.classList.remove("active");
      msg.textContent = "";
      msg.style.color = "";
      form.reset();
    }

    function showSuccessNotification() {
      successNotification?.classList.add("show");
      setTimeout(() => successNotification?.classList.remove("show"), 5000);
    }

    form.addEventListener("submit", (e) => {
      e.preventDefault();

      const login = form.login.value.trim();
      const email = form.email.value.trim();
      const pass1 = form.password.value.trim();
      const pass2 = form.password2.value.trim();

      msg.textContent = "";
      msg.style.color = "";

      if (login.length < 3)
        return showError("Логін має бути не менше 3 символів!");
      if (!email) return showError("Введіть email!");
      if (pass1.length < 6)
        return showError("Пароль має бути не менше 6 символів!");
      if (pass1 !== pass2) return showError("Паролі не співпадають!");

      msg.style.color = "#4a8d7c";
      msg.textContent = "Відправка...";

      fetch("php/register.php", {
        method: "POST",
        body: new FormData(form),
      })
        .then((res) => res.text())
        .then((data) => {
          const serverResponse = data.trim();
          if (serverResponse.startsWith("✅")) {
            closeModal();
            showSuccessNotification();
          } else {
            showError(serverResponse);
          }
        })
        .catch(() => showError("❌ Помилка з'єднання з сервером!"));
    });

    function showError(text) {
      msg.style.color = "red";
      msg.textContent = text;
    }
  }

  // Активне меню та плавний скрол
  document.querySelectorAll('a[href^="#"]').forEach((a) => {
    a.addEventListener("click", function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute("href"));
      if (!target) return;
      window.scrollTo({ top: target.offsetTop - 90, behavior: "smooth" });
      const toggle = document.getElementById("menu-toggle");
      if (toggle) toggle.checked = false;
    });
  });

  window.addEventListener("scroll", () => {
    let current = "";
    document.querySelectorAll("section").forEach((sec) => {
      if (pageYOffset >= sec.offsetTop - 150) current = sec.id;
    });

    document.querySelectorAll("nav a, .menu-item").forEach((link) => {
      link.classList.toggle(
        "active",
        link.getAttribute("href") === "#" + current
      );
    });
  });
});

// Бургер меню 
document.addEventListener("DOMContentLoaded", function () {
  const burgerMenu = document.getElementById("burgerMenu");
  const navWrapper = document.getElementById("navWrapper");

  const overlay = document.createElement("div");
  overlay.className = "menu-overlay";
  document.body.appendChild(overlay);

  burgerMenu.addEventListener("click", function () {
    burgerMenu.classList.toggle("active");
    navWrapper.classList.toggle("active");
    overlay.classList.toggle("active");

    document.body.style.overflow = navWrapper.classList.contains("active")
      ? "hidden"
      : "";
  });

  overlay.addEventListener("click", closeMenu);

  const navLinks = navWrapper.querySelectorAll("nav a");
  navLinks.forEach((link) => {
    link.addEventListener("click", closeMenu);
  });

  window.addEventListener("resize", function () {
    if (window.innerWidth > 768) {
      closeMenu();
    }
  });

  function closeMenu() {
    burgerMenu.classList.remove("active");
    navWrapper.classList.remove("active");
    overlay.classList.remove("active");
    document.body.style.overflow = "";
  }
});