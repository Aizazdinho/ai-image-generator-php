<?php   
    //Include classes
    require 'classes/ImageGenerator.php';
    //instaiate the object
    $genObj  = new ImageGenerator;
    //OpenAI Secret Token
    define('API_TOKEN', 'Your-OPEN-AI-KEY');

    //create a site url constaint;
    define('BASE_URL', 'http://localhost/ai-image-generator/');
