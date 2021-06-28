const dropArea = document.querySelector(".drag-area"),
    dragText = dropArea.querySelector("header"),
    button = dropArea.querySelector(".browse"),
    input = dropArea.querySelector("input"),
    editButton = document.querySelector(".task-content .task-file .edit"),
    inputFile = document.querySelector(".task-content .input-file"),
    backFile = inputFile.querySelector(".cancel"),
    fileArea = inputFile.querySelector(".file-area"),
    confirmFile = inputFile.querySelector(".confirm"),
    submitFile = inputFile.querySelector(".submit"),
    chooseFile = inputFile.querySelector(".choose"),
    submitNote = document.querySelector("section.task .back .submit"),
    noteButton = document.querySelector("section.task .task-detail .task-content button.submitNote");
let inputedFile;

editButton.onclick = () => {
    inputFile.setAttribute("id", "show");
}

backFile.onclick = () => {
    inputFile.removeAttribute("id", "show");
    fileArea.removeAttribute("id", "show");
}

confirmFile.onclick = () => {
    submitFile.click();
}

submitNote.onclick = () => {
    noteButton.click();
}

chooseFile.onclick = (event) => {
    event.preventDefault();
    input.click();
}

button.onclick = (event) => {
    event.preventDefault();
    input.click();
}

input.addEventListener("change", function() {
    inputedFile = this.files[0];
    console.log(inputedFile)
    showFile();
    dropArea.classList.add("active");
});

dropArea.addEventListener("dragover", (event) => {
    event.preventDefault();
    dropArea.classList.add("active");
    dragText.textContent = "Lepaskan File";
});

dropArea.addEventListener("dragleave", () => {
    dropArea.classList.remove("active");
    dragText.textContent = "Letakkan File Disini";
});

dropArea.addEventListener("drop", (event) => {
    event.preventDefault();
    inputedFile = event.dataTransfer.files[0];
    showFile();
});

function showFile() {
    let fileType = inputedFile.type;

    let validExtension = ["image/jpeg", "image/jpg", "image/png", "application/pdf", "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "text/plain", "application/msword", "application/vnd.openxmlformats-officedocument.presentationml.presentation"];

    let imageExtension = ["image/jpeg", "image/jpg", "image/png"];

    if (validExtension.includes(fileType)) {
        if (imageExtension.includes(fileType)) {
            let fileReader = new FileReader();
            fileReader.onload = () => {
                let fileUrl = fileReader.result;
                let imgTag = `<img src="${fileUrl}" alt="">`;
                fileArea.setAttribute("id", "show");
                fileArea.innerHTML = imgTag;
            }
            fileReader.readAsDataURL(inputedFile);
        } else {
            let fileName = inputedFile.name;
            let divTag = `<div class="file-name">${fileName}</div>`;
            fileArea.setAttribute("id", "show");
            fileArea.innerHTML = divTag;
        }


    } else {
        alert("Format file tidak didukung");
    }
}