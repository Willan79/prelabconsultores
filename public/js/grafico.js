//! grafico 01
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("grafico1").getContext("2d");
    var grafico = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril"],
            datasets: [
                {
                    label: "Empresas",
                    data: [12, 9, 3, 7],

                    backgroundColor: [
                        "rgba(225, 99, 32, 1)",
                        "rgba(75, 192, 192, 0.7)",
                        "rgba(54, 162, 235, 0.7)",
                    ],

                    borderColor: "rgba(225, 255, 32, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
        },
    });
});
//!===========================================================

//! grafico 02
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("grafico2").getContext("2d");
    var grafico = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio"],
            datasets: [
                {
                    label: "Auditorias",
                    data: [12, 9, 3, 7, 5, 9, 2],

                    backgroundColor: [
                        "rgba(225, 99, 32, 1)",
                        "rgba(255, 205, 86, 0.7)",
                        "rgba(75, 192, 192, 0.7)",
                        "rgba(54, 162, 235, 0.7)",
                        "rgba(225, 99, 32, 1)",
                        "rgba(153, 102, 255, 0.7)",
                        "rgba(255, 59, 64, 0.7)",
                    ],

                    borderColor: "rgba(225, 255, 32, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
        },
    });
});
//!===========================================================

//! grafico 03
document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("grafico3").getContext("2d");
    var grafico = new Chart(ctx, {
        type: "bar",
        data: {
            labels: ["Clientes", "Proveedores"],
            datasets: [
                {
                    label: "usuarios",
                    data: [21, 9],

                    backgroundColor: [
                        "rgba(225, 99, 32, 1)",
                        "rgba(153, 102, 255, 0.7)",
                    ],

                    borderColor: "rgba(225, 255, 32, 1)",
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
        },
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const elements = document.querySelectorAll(".fade-in");

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("aparece");
            }
        });
    });

    elements.forEach(el => observer.observe(el));
});
