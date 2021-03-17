<div class="btn-group">
  <button type="button" id="emp_btn" class="btn btn-falcon-default disabled border" onclick="showOnly('employee');">Create employee</button>
  <button type="button" id="sl_btn" class="btn btn-falcon-default" onclick="showOnly('salary');">Salary details</button>
  <button type="button" id="hr_btn" class="btn btn-falcon-default" onclick="showOnly('hr');">Hr details</button>
  <button type="button" id="cn_btn" class="btn btn-falcon-default" onclick="showOnly('contact');">Contact details</button>
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

    const emp_btn = document.querySelector("#emp_btn");
    const sl_btn = document.querySelector("#sl_btn");
    const hr_btn = document.querySelector("#hr_btn");
    const cn_btn = document.querySelector("#cn_btn");


    switch (tab) {
      case "employee":
        create_employee.classList.remove("hide-this");
        salary_details.classList.add("hide-this");
        hr_details.classList.add("hide-this");
        contact_details.classList.add("hide-this");

        emp_btn.classList.add("disabled", "border");
        sl_btn.classList.remove("disabled", "border");
        hr_btn.classList.remove("disabled", "border");
        cn_btn.classList.remove("disabled", "border");
        break;
      case "salary":
        create_employee.classList.add("hide-this");
        salary_details.classList.remove("hide-this");
        hr_details.classList.add("hide-this");
        contact_details.classList.add("hide-this");

        emp_btn.classList.remove("disabled", "border");
        sl_btn.classList.add("disabled", "border");
        hr_btn.classList.remove("disabled", "border");
        cn_btn.classList.remove("disabled", "border");
        break;
      case "hr":
        create_employee.classList.add("hide-this");
        salary_details.classList.add("hide-this");
        hr_details.classList.remove("hide-this");
        contact_details.classList.add("hide-this");

        emp_btn.classList.remove("disabled", "border");
        sl_btn.classList.remove("disabled", "border");
        hr_btn.classList.add("disabled", "border");
        cn_btn.classList.remove("disabled", "border");
        break;
      case "contact":
        create_employee.classList.add("hide-this");
        salary_details.classList.add("hide-this");
        hr_details.classList.add("hide-this");
        contact_details.classList.remove("hide-this");

        emp_btn.classList.remove("disabled", "border");
        sl_btn.classList.remove("disabled", "border");
        hr_btn.classList.remove("disabled", "border");
        cn_btn.classList.add("disabled", "border");
        break;
    }
  }
</script>
