$(document).ready(function () {
    var ontest = store.get('wordcounter');
    //Select Text Box
    var textbox = $('#textbox');
    //Focus On TexBox Filed After Load Document
    textbox.focus();

    // For Storing data on text area
        textbox.val(ontest)

    //Count On Writing...
    addEventListener('input', function () {
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
        store('wordcounter', textbox.val());
    });

});