<?php
/*
 * PHP Techdegree Project 2: Build a Quiz App in PHP
 *
 * These comments are to help you get started.
 * You may split the file and move the comments around as needed.
 *
 * You will find examples of formating in the index.php script.
 * Make sure you update the index file to use this PHP script, and persist the users answers.
 *
 * For the questions, you may use:
 *  1. PHP array of questions
 *  2. json formated questions
 *  3. auto generate questions
 *
 */
session_start();
// Include questions
include ('generate_questions.php');

// Set session indexes that will be used to avoid warning messages

if(!isset($_SESSION['count'])) {
    $_SESSION['count'] = 1;
}

if(!isset($_SESSION['numCorrect'])) {
    $_SESSION['numCorrect'] = 0;
}

if(!isset($_SESSION['lastCorrect'])) {
    $_SESSION['lastCorrect'] = "";
}

// Generate correct number of questions

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    if (isset($_POST['questionCount'])) {
        $_SESSION['questionCount'] = $_POST['questionCount'];
        randomEquation($_SESSION['questionCount']);
        header('location: ../index.php');
        exit;
    }

    //Check for correct answer submission and move count up 1

    if (isset($_POST['correct']) and $_SESSION['count'] <= $_SESSION['questionCount']) {
        ++$_SESSION['numCorrect'];
        ++$_SESSION['count'];

            if(isset($_SESSION['lastCorrect'])) {
                $_SESSION['lastCorrect'] = true;
            } else {
                $_SESSION['lastCorrect'] = "";
            }


            if($_SESSION['count'] > $_SESSION['questionCount']){
                header('location: ../finalscore.php');
            } else {
                header('location: ../index.php');
            }
        
    // Check for incorrect answer submissions

    } elseif (isset($_POST['wrong']) and $_SESSION['count'] <= $_SESSION['questionCount']) {
        ++$_SESSION['count'];

        if(isset($_SESSION['lastCorrect'])) {
            $_SESSION['lastCorrect'] = false;
        } else {
            $_SESSION['lastCorrect'] = "";
        }


            if($_SESSION['count'] > $_SESSION['questionCount']){
                header('location: ../finalscore.php');
            } else {
                header('location: ../index.php');
            }
    } 
}



// Keep track of which questions have been asked
// Show which question they are on

// Show random question

// Shuffle answer buttons

// Toast correct and incorrect answers

// Keep track of answers

// If all questions have been asked, give option to show score
// else give option to move to next question


// Show score