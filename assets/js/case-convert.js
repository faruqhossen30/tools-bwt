$(document).ready(function () {
	var caseconverter = store.get('caseconverter');
	$("#input-text").val(caseconverter);
	//convert to Sentence case on click
	$("#sentence-case").click(function () {
		//get text
		var input_text = multiSpaceCheck($("#input-text").val());

		//format input text
		// var formatted_text = setTitleCase(input_text);
		var formatted_text = sentenceCase(input_text);
		//set input-text
		$("#input-text").val(formatted_text);
	});

	//function to convert text to Sentence case
	function sentenceCase(string) {
		var newString = string
			.toLowerCase()
			.replace(/(^\s*\w|[\.\!\?]\s*\w)/g, function (c) {
				return c.toUpperCase();
			});
		return newString;
	}

	//convert to title case on click
	$("#title-case").click(function () {
		//get text
		var input_text = multiSpaceCheck($("#input-text").val());

		//format input text
		var formatted_text = setTitleCase(input_text);

		//set input-text
		$("#input-text").val(formatted_text);
	});

	//function to convert text to title case
	function setTitleCase(input_text) {

		//exclude articles, cordinate conjunction, and some prepositions
		var exclude_array = ['a', 'is', 'an', 'the', 'for', 'and', 'nor', 'but', 'or', 'yet', 'so', 'at', 'by', 'after', 'along', 'for', 'from', 'of', 'on', 'to'];

		//split string by space
		var split_string = input_text.toLowerCase().split(' ');
		var string_length = split_string.length;
		for (var i = 0; i < string_length; i++) {

			//always capitalize first letter/word
			if (i == 0) {
				split_string[i] = split_string[i].charAt(0).toUpperCase() + split_string[i].substring(1);
			}
			else {
				//if not in exclude Array
				if ((jQuery.inArray(split_string[i].toLowerCase(), exclude_array) < 0)) {
					// set string back to the array
					split_string[i] = split_string[i].charAt(0).toUpperCase() + split_string[i].substring(1);
				}
				else {
					// set string back to the array as a lowercase
					split_string[i] = split_string[i].charAt(0).toLowerCase() + split_string[i].substring(1);
				}
			}
		}

		//return the joined string
		return split_string.join(' ');
	}



	//convert to capitalize case on click
	$("#capitalize-case").click(function () {
		//get text
		var input_text = multiSpaceCheck($("#input-text").val());

		//format input text
		var formatted_text = setCapitalizeCase(input_text);

		//set input-text
		$("#input-text").val(formatted_text);
	});


	//function to convert text to capitalize case
	function setCapitalizeCase(input_text) {
		//split string by space
		var split_string = input_text.toLowerCase().split(' ');
		var string_length = split_string.length;
		for (var i = 0; i < string_length; i++) {
			// set string back to the array
			split_string[i] = split_string[i].charAt(0).toUpperCase() + split_string[i].substring(1);
		}

		//return the joined string
		return split_string.join(' ');
	}


	//convert to lowercase case on click
	$("#lower-case").click(function () {

		//get text
		var input_text = multiSpaceCheck($("#input-text").val());

		//format input text
		var formatted_text = input_text.toLowerCase();

		//set input-text
		$("#input-text").val(formatted_text);
	});


	//convert to upper case on click
	$("#upper-case").click(function () {

		//get text
		var input_text = multiSpaceCheck($("#input-text").val());

		//format input text
		var formatted_text = input_text.toUpperCase();

		//set input-text
		$("#input-text").val(formatted_text);
	});


	//convert to bold text on click
	$("#bold-text").click(function () {
		//get text
		var input_text = multiSpaceCheck($("#input-text").val());

		//format input text
		var formatted_text = "<strong>" + input_text + "</strong>";

		//set input-text
		$("#input-text-div").html(formatted_text);
	});


	//convert to underline text on click
	$("#underline-text").click(function () {
		//get text
		var input_text = multiSpaceCheck($("#input-text").val());

		//format input text
		var formatted_text = "<u>" + input_text + "</u>";

		//set input-text
		$("#input-text-div").html(formatted_text);
	});


	//convert to strikethrough text on click
	$("#strike-through").click(function () {

		//get text
		var input_text = multiSpaceCheck($("#input-text").val());

		//format input text
		var formatted_text = "<strike>" + input_text + "</strike>";

		//set input-text
		$("#input-text-div").html(formatted_text);
	});


	//this function checks if to remove multiple spaces
	function multiSpaceCheck(input_string) {
		//get checkbox status    
		var remove_multi_spaces = $('#rem-multi-space').is(":checked");

		//if true, replace all multiple spaces with one (if existing)
		if (remove_multi_spaces) {
			input_string = input_string.replace(/\s\s+/g, ' ');
		}
		return input_string;
	}

	//Copy input data
	$("#copy").click(function () {
		//get text
		$("#input-text").select();
		document.execCommand('copy');
	});
	//Copy input data
	$("#clear").click(function () {

		$("#input-text").val('')
	});


	// For Word Counter
	addEventListener('input', function () {
		var textbox =$("#input-text");
        //Count Characters With Space
        var charactersS = textbox.val().length;
        //Count Characters Without Space
        var charactersWS = textbox.val().replace(/\s+/g, '').length;
        //Count Words
        var wordsC = textbox.val().match(/\S+/g);
        var words = wordsC ? wordsC.length : 0;
        //Count Lines
        var lines = textbox.val().split(/\n/).length;
        var para = textbox.val().replace(/\n$/gm, '').split(/\n/).length

        // Show Output
        $('#characterButton').html(charactersS);
        $('#characters_with_spacesButton').html(charactersWS);
        $('#wordsButton').html(words);
        $('#lineButton').html(lines);
        $('#paragraphButton').html(para);

        // Store2 Js
        store('caseconverter', textbox.val());
    });


	function wordCounter(){
		var textbox =$("#input-text");
        //Count Characters With Space
        var charactersS = textbox.val().length;
        //Count Characters Without Space
        var charactersWS = textbox.val().replace(/\s+/g, '').length;
        //Count Words
        var wordsC = textbox.val().match(/\S+/g);
        var words = wordsC ? wordsC.length : 0;
        //Count Lines
        var lines = textbox.val().split(/\n/).length;
        var para = textbox.val().replace(/\n$/gm, '').split(/\n/).length

        // Show Output
        $('#characterButton').html(charactersS);
        $('#characters_with_spacesButton').html(charactersWS);
        $('#wordsButton').html(words);
        $('#lineButton').html(lines);
        $('#paragraphButton').html(para);

        // Store2 Js
        store('caseconverter', textbox.val());
	}





});