// setup an "add a participant" link
var $addparticipantLink = $('<a href="#" class="add_participant_link">Add a participant</a>');
var $newLinkLi = $('<li></li>').append($addparticipantLink);

jQuery(document).ready(function() {
    // Get the ul that holds the collection of participants
    var $collectionHolder = $('ul.participants');

    // add the "add a participant" anchor and li to the participants ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addparticipantLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new participant form (see code block below)
        addparticipantForm($collectionHolder, $newLinkLi);
    });


});

function addparticipantForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a participant" link li
    var $newFormLi = $('<li></li>').append(newForm);

    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-participant">x</a>');

    $newLinkLi.before($newFormLi);

    // handle the removal, just for this example
    $('.remove-participant').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });
}