function addExpense() {
    const crop = document.getElementById("cropSelect").value;
    const otherCrop = document.getElementById("otherCrop").value;
    const category = document.getElementById("category").value;
    const amount = document.getElementById("amount").value;
    const note = document.getElementById("note").value;

    if (!crop || !category || !amount) {
        alert("Please fill all required fields");
        return;
    }

    const cropName = crop === "Other" ? otherCrop : crop;

    const expense = {
        crop: cropName,
        category,
        amount: Number(amount),
        note,
        date: new Date().toLocaleDateString()
    };

    expenses.push(expense);

    displayExpenses();
    calculateTotals();

    // 🔥 SAVE TO DATABASE USING AJAX
    fetch("save_expense.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `crop=${cropName}&category=${category}&amount=${amount}&note=${note}`
    })
    .then(response => response.text())
    .then(data => {
        if(data.trim() === "success"){
            console.log("Saved to database");
        } else {
            console.log("Database error");
        }
    });

    document.getElementById("amount").value = "";
    document.getElementById("note").value = "";
}