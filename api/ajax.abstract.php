<?php
  abstract class AjaxAbstract {
    abstract protected function setupHeaders();
    abstract protected function writeResponse($data);
    abstract protected function writeError($e);
    abstract protected function execUsecase();

    // Common method
    public function requestResponseFlow() {
      try { 
        $this->setupHeaders();
        $this->writeResponse($this->execUsecase());
      } catch(Exception $e) {
        $this->writeError($e);
      }
    }
  }

  class LoremRequests extends AjaxAbstract {
    protected function setupHeaders() {
      header('Content-type: application/json');
    }

    public function getInputs() {
      return "{$prefix}ConcreteClass1";
    }

    public function validateInputs() {
      if ($_SERVER['REQUEST_METHOD'] !== "POST") {
        throw new Exception('Invalid Request', 2000);
      }

      if (empty($_POST['email'])) {
        throw new Exception('Invalid Input', 200);
      } else {
          $email = $_POST['email'];
      }
    }

    public function execUsecase() {
      return array(
        "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean condimentum metus dui, eu venenatis diam tempor quis. Nunc id tristique magna. Fusce pretium nunc eu scelerisque feugiat. Duis id efficitur nunc. Maecenas quis fermentum purus. Proin viverra pulvinar velit, ut lacinia dolor faucibus eu. Donec finibus tortor ipsum, vitae pretium sapien malesuada sit amet. Fusce vitae suscipit libero, non hendrerit urna. Proin ultrices, tortor non aliquet hendrerit, est erat vehicula diam, eget varius urna mauris sit amet sem. Proin malesuada augue viverra ullamcorper imperdiet. Etiam lacinia, ligula varius pulvinar pellentesque, metus nisl sagittis erat, eget condimentum est libero ac lorem. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Quisque eu eros ac massa rutrum tincidunt. Mauris sollicitudin lorem tempus mattis laoreet. Aenean blandit est sed ullamcorper volutpat. Nulla id condimentum lorem."
      );
    }

    public function writeResponse($data) {
      // status is true if everything is fine
      exit(json_encode(
        array_merge(
          array(
              'status' => true
          ),
          $data
        )
      ));
    }

    public function writeError($e) {
      echo json_encode(
        array(
            'status' => false,
            'error' => $e -> getMessage(),
            'error_code' => $e -> getCode()
        )
      );

      exit;
    }
  }

  $loremRequests = new LoremRequests;
  $loremRequests->requestResponseFlow();

  
?>