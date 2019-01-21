function isEmpty(str) {
    return (!str || 0 === str.length);
}
function validateRegister() {
    var pseudo = $('#pseudo').val();
    var type = $('#type').val();
    var genre = $('#genderSelect').val();
    var bio = $('#bioText').val();
    var age = $('#ageText').val();
    var location = $('#locationSelect').val()

    if (type == 2) {
        if (isEmpty(pseudo)) {
            alert('Veuillez saisir votre pseudo');
            return false;
        }
        if (isEmpty(type)) {
            alert('Veuillez saisir votre type de snapper');
            return false;
        }
        if (isEmpty(genre)) {
            alert('Veuillez saisir votre genre');
            return false;
        }
        if (isEmpty(bio)) {
            alert('Veuillez saisir une description');
            return false;
        }
        if (isEmpty(age)) {
            alert('Veuillez saisir votre age');
            return false;
        }
        if (isEmpty(location)) {
            alert('Veuillez saisir votre région');
            return false;
        }
    } else {
        if (isEmpty(pseudo)) {
            alert('Veuillez saisir votre pseudo');
            return false;
        }
        if (isEmpty(type)) {
            alert('Veuillez saisir votre type de snapper');
            return false;
        }
        if (isEmpty(location)) {
            alert('Veuillez saisir votre région');
            return false;
        }
	}
	
	if(age < 18 ){
		alert('Désolé, il faut être majeur pour s\'inscrire sur ce site');
		return false;
	}

    return true;
}


$(function () {

    $('#registerForm').submit(function (e) {
        console.log('here');
        e.preventDefault();
        if (validateRegister() == true) {
            $('#registerForm').unbind('submit').submit();
        }
    });
    $("#type").change(function () {
        var type = $("#type").val();
        if (type == 0) {
            $("#genderContainer").hide();
            $("#bioContainer").hide();
            $("#ageContainer").hide();
        }
        else if (type == 1) {
            $("#genderContainer").hide();
            $("#bioContainer").hide();
            $("#ageContainer").hide();
        }
        else if (type == 2) {
            $("#genderContainer").show();
            $("#bioContainer").show();
            $("#ageContainer").show();
        }
    });
});