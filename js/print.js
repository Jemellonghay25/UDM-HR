
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector(".print-btn button").addEventListener("click", function () {
        let printContent = document.querySelector(".dtcontainer").innerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = printContent;
        window.print();
        document.body.innerHTML = originalContent;
        location.reload(); // Reload the page to restore original content
    });
});

