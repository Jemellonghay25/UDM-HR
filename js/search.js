$(document).ready(function () {
    // Search functionality
    $("#search").on("keyup", function () {
      let searchTerm = $(this).val().toLowerCase();
      $("#empTableBody tr").filter(function () {
        $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
      });
    });

    // Dropdown filtering
    $(".dropdown-menu a").on("click", function (e) {
      e.preventDefault();
      // Get the department selected (use "all" to show all rows)
      let selectedDept = $(this).data("dept");
      // Update the dropdown button text to the selected department (capitalize if not "all")
      let btnText = (selectedDept === "all") ? "Department" : selectedDept.toUpperCase();
      $("#deptDropdown").text(btnText);

      // Filter table rows by department column (assumed to be the 4th column, index 3)
      $("#empTableBody tr").filter(function () {
        let deptText = $(this).find("td:eq(3)").text().toLowerCase();
        if (selectedDept === "all") {
          $(this).toggle(true);
        } else {
          $(this).toggle(deptText.indexOf(selectedDept) > -1);
        }
      });
    });
  });