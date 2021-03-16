<div>
  <button type="button" class="btn" onclick="showOnly('employee');">Create employee</button>
  <button type="button" class="btn" onclick="showOnly('salary');">Salary details</button>
  <button type="button" class="btn" onclick="showOnly('hr');">Hr details</button>
  <button type="button" class="btn" onclick="showOnly('contact');">Contact details</button>
</div>

<style>
  .hide-this {
    display: none;
  }
</style>

<script>
  function showOnly(tab) {
    const create_employee = document.querySelector("#create_employee");
    const salary_details = document.querySelector("#salary_details");
    const hr_details = document.querySelector("#hr_details");
    const contact_details = document.querySelector("#contact_details");

    switch (tab) {
      case "employee":
        create_employee.classList.remove("hide-this");
        salary_details.classList.add("hide-this");
        hr_details.classList.add("hide-this");
        contact_details.classList.add("hide-this");
        break;
      case "salary":
        create_employee.classList.add("hide-this");
        salary_details.classList.remove("hide-this");
        hr_details.classList.add("hide-this");
        contact_details.classList.add("hide-this");
        break;
      case "hr":
        create_employee.classList.add("hide-this");
        salary_details.classList.add("hide-this");
        hr_details.classList.remove("hide-this");
        contact_details.classList.add("hide-this");
        break;
      case "contact":
        create_employee.classList.add("hide-this");
        salary_details.classList.add("hide-this");
        hr_details.classList.add("hide-this");
        contact_details.classList.remove("hide-this");
        break;
    }
  }
</script>