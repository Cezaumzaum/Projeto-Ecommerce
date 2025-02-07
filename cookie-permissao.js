
document.addEventListener("DOMContentLoaded", function () {
  const cookieBanner = document.getElementById("cookie-banner");
  const acceptCookiesBtn = document.getElementById("accept-cookies");

  // Verifica se o cookie já foi aceito
  if (!localStorage.getItem("cookiesAccepted")) {
    cookieBanner.classList.add("show"); // Adiciona a classe para mostrar o banner
  }

  // Evento para aceitar cookies
  acceptCookiesBtn.addEventListener("click", function () {
    localStorage.setItem("cookiesAccepted", "true"); // Armazena a aceitação dos cookies
    cookieBanner.classList.remove("show"); // Oculta o banner
  });
});

