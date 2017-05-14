<?php

include_once 'MoveInterface.php';

/**
 * Created by PhpStorm.
 * User: mladen.batakovic
 * Date: 14.5.17.
 * Time: 14.34
 */
class Api implements MoveInterface
{

	private $winScore = 900;

	/**
	 * @param array $boardState
	 * @param string $playerUnit
	 * @return array
	 */
	function makeMove($boardState, $playerUnit = 'X') {

		$mustBlockRow =-1;
		$mustBlockCol =-1;
		$bestRow      =-1;
		$bestCol      =-1;
		$winningRow   =-1;
		$winningCol   =-1;
		$bestScore    =-1;
		$x            = '';
		$y            = '';
		$otherPlayer  = ($playerUnit == 'X') ? '0' : 'X';

		for ($row=0; $row<3; $row++) {
			for ($col=0; $col<3; $col++) {
				// check empty grids and see how we fare we we put a piece on it
				if ($boardState[$row][$col] == '') {
					//see whether enemy will win or not if we don't pick this pos
					$score = $this->how_good($boardState, $row, $col, $playerUnit, $otherPlayer);
					if ($score >= $this->winScore) {
						$mustBlockCol = $col;
						$mustBlockRow = $row;
						$bestRow      = $row;
						$bestCol      = $col;
					}
					//how good is this position?
					$newScore = $this->how_good($boardState, $row, $col, $otherPlayer, $playerUnit);
					//echo "newScore=".$newScore;
					//if better than previous one, select
					// (also select randomly if we got a same score, so that
					// the computer doesn't always pick the same move)
					if (($bestScore < $newScore) || (($bestScore == $newScore) && rand(0,100)>50)) {
						$bestScore = $newScore;
						$bestRow   = $row;
						$bestCol   = $col;
					}

				}
			}
		}

		//if we have a winning position, pick it
		if ($bestScore >= $this->winScore) {
			$x = $bestRow;
			$y = $bestCol;
		}
		//if we have a position that must be blocked or else the enemy will win, block it
		else if ($mustBlockCol != -1) {
			$x = $mustBlockRow;
			$y = $mustBlockCol;
		}
		//else, pick the best move
		else if ($boardState[$bestRow][$bestCol] == '') {
			$x = $bestRow;
			$y = $bestCol;
		}

		return array($x, $y, $otherPlayer);
	}

	/**
	 * Find out how good a move is
	 * @param array $boardState
	 * @param int $row
	 * @param int $col
	 * @param string $good
	 * @param string $bad
	 * @return int
	 */
	function how_good($boardState, $row, $col, $good, $bad)
	{
		$score=0;
		//check horizontal
		$occupied      = 0;
		$totalOccupied = 0;
		for ($c=0; $c<3; $c++)
		{
			//straight line from this position is blocked
			if ($boardState[$row][$c] == $bad)
			{
				$occupied = 0;
				$score++;
				break;
			}
			else
			{
				#straight line from this position is not blocked
				if ($c==2) {
					$score++;
				}
				if ($boardState[$row][$c] == $good) {
					$occupied++;
				}
			}
		}

		if ($occupied == 2) {
			$totalOccupied+= $this->winScore;
		}
		$totalOccupied+= $occupied;

		#check vertical
		$occupied = 0;
		for ($r=0; $r<3; $r++) {
			if ($boardState[$r][$col] == $bad) {
				$occupied = 0;
				$score++;
				break;
			}
			else {
				if ($r==2) {
					$score++;
				}
				if ($boardState[$r][$col] == $good) {
					$occupied++;
				}
			}
		}

		if ($occupied == 2) {
			$totalOccupied+= $this->winScore;
		}
		$totalOccupied+=$occupied;

		#check diagonal left-right
		if ($row == $col) {
			$occupied = 0;
			for ($i=0; $i<3; $i++) {
				if ($boardState[$i][$i] == $bad) {
					$occupied = 0;
					$score++;
					break;
				}
				else {
					if ($i == 2) {
						$score++;
					}

					if ($boardState[$i][$i] == $good) {
						$occupied++;
					}
				}
			}
			if ($occupied == 2) {
				$totalOccupied+=$this->winScore;
			}
		}

		$totalOccupied+=$occupied;

		#check diagonal right-left
		if ($row == 2-$col) {
			$occupied = 0;
			for ($i=0; $i<3; $i++)
			{
				if ($boardState[$i][2-$i] == $bad) {
					$occupied=0;
					$score++;
					break;
				}
				else {
					if ($i == 2) {
						$score++;
					}

					if ($boardState[$i][2-$i] == $good) {
						$occupied++;
					}
				}
			}
			if ($occupied == 2) {
				$totalOccupied+=$this->winScore;
			}
		}

		$totalOccupied+=$occupied;
		$score+=$totalOccupied;
		#print "<H1>$good, r: $row, c: $col, s:$score </H1>";
		return $score;
	}

}