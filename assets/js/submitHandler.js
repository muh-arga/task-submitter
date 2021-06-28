const submitText = document.querySelector("section.task .back .submit"),
    submitButton = document.querySelector("section.task .task-detail .task-content button.submitNote");

submitText.onclick = () => {
    submitButton.click();
}