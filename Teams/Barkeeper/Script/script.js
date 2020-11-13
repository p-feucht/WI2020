function createNewElement() {
    var fieldsadded = 1;
    // First create a DIV element.
    var txtNewInputBox = document.createElement('div');

    // Then add the content (a new input box) of the element.
    txtNewInputBox.innerHTML = "<input type='text' id='newInputBox' placeholder=''>";

    // Finally put it where it is supposed to appear.
    document.getElementById("newElementId").appendChild(txtNewInputBox);
    fieldsadded++;
}
