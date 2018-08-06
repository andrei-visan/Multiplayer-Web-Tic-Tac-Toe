<?php
session_start();

require_once 'idiorm.php';
ORM::configure('sqlite:db.sqlite');

function check_board($board) {

    // check line win
    for ($i = 0; $i < 8; $i += 3) {
        if ($board[$i] == $board[$i + 1] &&
            $board[$i] == $board[$i + 2]) {
                if ($board[$i] == 'x')
                    return 'x';
                if ($board[$i] == 'o')
                    return 'o';
            }
    }


    // check column win
    for ($i = 0; $i < 3; $i++) {
        if ($board[$i] == $board[$i + 3] &&
            $board[$i] == $board[$i + 6]) {

            if ($board[$i] == 'x')
                return 'x';
            if ($board[$i] == 'o')
                return 'o';
        }
    }

    // check diagonal win
    if (($board[0] == $board[4] && $board[0] == $board[8]) ||
        ($board [2] == $board[4] && $board[2] == $board[6])) {

        if ($board[4] == 'x')
            return 'x';
        if ($board[4] == 'o')
            return 'o';
    }

    // check for draw
    if (!strstr($board, '-'))
        return 'd';

    // game not yet over
    return 'n';
}


$game = ORM::for_table('games')
->where_any_is(array(
    array('player1' => $_SESSION['username']),
    array('player2' => $_SESSION['username'])))
->findOne();

$enemy = $game->player1 == $_SESSION['username'] ? $game->player2 : $game->player1;
$turn = $game->turn == $_SESSION['username'];

$result_ret = "";

if (isset($_GET['move'])) {
    if (!$turn || $enemy == '') {
        echo 'Not your turn!';
        exit();
    }

    $pos = $_GET['move'];
    if ($game->board[$pos] == '-') {
        $symbol = ($game->player1 == $_SESSION['username']) ? 'x' : 'o';

        $board = $game->board;
        $board[$pos] = $symbol;

        $game->board = $board;
        $game->save();
        
        $result = check_board($board);
        
        // if game ended
        if ($result != 'n') {

            $playerP = ORM::for_table('users')
            ->where('username', $_SESSION['username'])
            ->findOne();

            $enemyP = ORM::for_table('users')
            ->where('username', $enemy)
            ->findOne();

            if ($result == 'd') {
                $game->result = '-';
                $game->save();
                $result_ret = 'draw';

                $drawsP = $playerP->draws + 1;
                $playerP->draws = $drawsP;
                $playerP->save();

                $drawsE = $enemyP->draws + 1;
                $enemyP->draws = $drawsE;
                $enemyP->save();
                
            }
            else
            {
                $game->result = $_SESSION['username'];
                $game->save();
                $result_ret = 'win';

                $winsP = $playerP->wins + 1;
                $playerP->wins = $winsP;
                $playerP->save();

                $lossesE = $enemyP->losses + 1;
                $enemyP->losses = $lossesE;
                $enemyP->save();
            }
        }

        $game->turn = $enemy;
        $game->save();

    }
    else {
        echo 'Invalid move';
        exit();
    }
}
else {    
    if ($game->result == '-')
        $result_ret = 'draw';
    if ($enemy != '' && $game->result == $enemy)
        $result_ret = 'lose';
    if ($game->result == $_SESSION['username'])
        $result_ret = 'win';
}

if ($result_ret != "")
        $turn = false;

$game_state = [ 'enemy' => $enemy, 'turn' => $turn, 'board' => $game->board, 'result' => $result_ret];

echo json_encode($game_state);