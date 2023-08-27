<?php 
    class ImageGenerator{
        //Properties
        //Store errors
        public $error;
        //Store User Prompt to generate the image
        public $prompt;
        //Store Api header to add api token to the api call
        public $headers;
        //This data will be attech to the api call to send the prompt
        public $data;

        //function to display errors
        public function errors(){
            return $this->error;
        }

        //function to set the api header to attech the API token
        public function setApiHeader(){
            $this->headers = 
            [
                'Authorization: Bearer ' . API_TOKEN,
                'Content-Type: application/json'
            ];
        }
        //function to set the prompt to the data property 
        public function setApiData(){
            $this->data = 
            [
                'prompt' => $this->prompt
            ];
        }
        //function to generate the image
        public function generate(){
            //set the api url for dall-e to generate the images
            $apiUrl = "https://api.openai.com/v1/images/generations";
            //call the function to set the header for api call
            $this->setApiHeader();
            //call the function to set the data to send
            $this->setApiData();
            //initializes a new cURL session. 
            $ch  = curl_init($apiUrl);
            //set options for cURL session to allow to post data
            curl_setopt($ch, CURLOPT_POST, true);
            //set the data to send via api call
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->data));
            //set the header(the token key)
            curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
            //set option to return the data
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            //send the request
            $response = curl_exec($ch);
            //close the cURL session
            curl_close($ch);
            //check if response return the api call
            if($response){
              //decode the json response returned from the api call 
              $responseData = json_decode($response, true);
              //now call the method to save the images to app
              $file = $this->saveImage($responseData['data'][0]['url']);
              //return file to use
              return $file;

            }else{
                //else set error to display
                $this->error = "API Request failed!";
                return false;
            }
        }

        //function to save the AI generated image to directory
        public function saveImage($response){
            //create variable to store image returned from the api call
            $imageUrl = $response;
            //set folder to save the image
            $uploadDir = 'frontend/uploads/';
            //Generate filename
            $filename = $uploadDir.md5(time()).'_.png';
            //create the image using the image
            file_put_contents($filename, file_get_contents($imageUrl));
            //return the image to display in main page
            return $filename;
        }
    }
