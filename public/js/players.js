window.addEventListener("load", handleWindowLoad);

function handleWindowLoad() {
    let inputPlayer = document.getElementById("inputPlayer");
    inputPlayer.addEventListener("input", handlePlayerInput);

    displayPlayersBox(false);
}

function handlePlayerInput() {
    let inputPlayer = document.getElementById("inputPlayer");
    let player = inputPlayer.value;
    const URL = '/fifa19/public/api/players/' + player;

    if (player == "") {
        displayPlayers([]);
    } else {
        fetch(URL)
            .then((response) => {
                return response.json()
            })
            .then((data) => {
                displayPlayers(data)
            })
            .catch((exception) => {
                console.log(exception.message);
            });
    }
}

function displayPlayers(data) {
    let playersList = document.getElementById("players");

    if (data.length == 0) {
        displayPlayersBox(false);
    } else {
        displayPlayersBox(true);

        playersList.innerHTML = "";

        for (let i = 0; i < data.length; i++) {
            let item = document.createElement("div"); /** A-tag */
            item.innerHTML = data[i].id + " - " + data[i].name + " - " + data[i].rating + " - " + data[i].cardtype;
            item.onclick = usePlayer;
            item.setAttribute("class", "dropdown-item");
            playersList.appendChild(item);
        }
    }
}

function usePlayer(event) {
    let player = event.target.innerHTML;
    let id = player.split(" - ")[0];
    let player_id = document.getElementById("player_id");
    player_id.value = id;
    let name = player.split(" - ")[1];
    let inputPlayer = document.getElementById("inputPlayer");
    inputPlayer.value = name;
    displayPlayersBox(false);
}

function displayPlayersBox(val) {
    let playersList = document.getElementById("players");

    if (val) {
        playersList.style.display = 'block';
    } else {
        playersList.style.display = 'none';
    }
}