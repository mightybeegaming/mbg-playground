function tagBuilder(tags) {
    tags = tags.split('|');

    let stringTags = '';
    for(let i = 0; i < tags.length; i++) {
        stringTags += '<span class="widget tag">' + tags[i] + '</span>';
    }

    return stringTags;
}