window.ownerInfoModelLabel = document.getElementById('ownerInfoModelLabel');
window.followers = document.getElementById('followers');
window.following = document.getElementById('following');
window.repositories = document.getElementById('repositories');

window.handleOwnerInfo = async function(event) {
    event.preventDefault();

    //add loading spinner
    event.target[1].innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>Show owner stats'

    //featch repo owner data
    const userInfoLink = event.target[0].value
    const data = await fetch(userInfoLink).then((response) => response.json());

    //attach data to dom
    ownerInfoModelLabel.innerHTML = data.login
    followers.value = data.followers
    following.value = data.following
    repositories.value = data.public_repos

    //lunch modal
    $('#ownerInfoModel').modal('toggle')

    //remove loading spinner
    event.target[1].innerHTML = 'Show owner stats'
}
