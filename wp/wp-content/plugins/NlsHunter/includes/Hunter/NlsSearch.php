<?php

require_once 'NlsService.php';
require_once 'NlsHelper.php';

/**
 * Description of NlsSearch
 *
 * @author nurielmeni
 */
class NlsSearch extends NlsService
{
    /**
     * 
     * @param type $config the $auth and $settings
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
        $this->init();
    }

    /**
     * Override init to set the service URL
     */
    public function init()
    {
        $this->url = $this->nlsConfig->getNlsSearchService();
        parent::init();
    }


    public function JobHuntersGetForUser()
    {
        $transactionCode = NlsHelper::newGuid();
        try {
            $params = array(
                "transactionCode" => $transactionCode,
                // "status" => $status
            );

            $res = $this->client->JobHuntersGetForUser($params);

            return $res;
        } catch (SoapFault $ex) {
            //var_dump($ex);
            throw new Exception('Error: SOAP Error: Check the log for more details.');
        } catch (Exception $ex) {
            $ex->transactionCode = $transactionCode;
            throw new Exception('Error: Niloos services are not availiable, try later.');
        }
    }

    public function JobHunterCreateOrUpdate($user_name, $filter, $hunterStatus)
    {

        $transactionCode = NlsHelper::newGuid();
        $hunter_id = null;
        try {

            $hunter_id = NlsHelper::newGuid();
            $params = array(
                "transactionCode" => $transactionCode,
                "hunterId" => $hunter_id,
                "hunterStatus" => $hunterStatus,
                "name" => null,
                "jobId" => null,
                "externalId" => null,
                "userDefined1" => null,
                "userDefined2" => null,
                "filter" => $filter
            );

            $res = $this->client->JobHunterCreateOrUpdate($params);

            return $hunter_id;
        } catch (SoapFault $ex) {
            //var_dump($ex);
            throw new Exception('Error: SOAP Error: Check the log for more details.');
        } catch (Exception $ex) {
            throw new Exception('Error: Niloos services are not availiable, try later.');
        }
    }

    public function JobHunterExecuteByHunterId2($hunter_id, $from, $ofset, $sinceLastQuery = true)
    {


        $transactionCode = NlsHelper::newGuid();
        try {


            $params = array(
                "transactionCode" => $transactionCode,
                "HunterId" => $hunter_id,
                "queryConfig" => array("ResultRowLimit" => $ofset, "ResultRowOffset" => $from),
                "sinceLastQuery" => $sinceLastQuery
            );
            $res = $this->client->JobHunterExecuteByHunterId2($params);
            return $res;
        } catch (SoapFault $ex) {
            //var_dump($ex);
            throw new Exception('Error: SOAP Error: Check the log for more details.');
        } catch (Exception $ex) {
            throw new Exception('Error: Niloos services are not availiable, try later.');
        }
    }


    public function applicantHunterExecuteNewQuery2($hunter_id, $from, $ofset, $filter)
    {
        $transactionCode = NlsHelper::newGuid();
        $hunter_id = NlsHelper::newGuid();
        try {
            $params = array(
                "transactionCode" => $transactionCode,
                "HunterId" => $hunter_id,
                "queryConfig" => array("ResultRowLimit" => $from, "ResultRowOffset" => $ofset),
                "oQueryInfo" => $filter
            );
            $res = $this->client->ApplicantHunterExecuteNewQuery2($params)->JobHunterExecuteNewQuery2Result; //->Results;
            return $res;
        } catch (SoapFault $ex) {
            //var_dump($ex);
            throw new Exception('Error: SOAP Error: Check the log for more details.');
        } catch (Exception $ex) {
            throw new Exception('Error: Niloos services are not availiable, try later.');
        }
    }

    public function JobHunterExecuteNewQuery2($hunter_id, $resultRowOffset, $resultRowLimit, $filter)
    {
        $transactionCode = NlsHelper::newGuid();
        try {
            $params = [
                "transactionCode" => $transactionCode,
                "HunterId" => $hunter_id,
                "queryConfig" => ["ResultRowLimit" => $resultRowLimit, "ResultRowOffset" => $resultRowOffset],
                "oQueryInfo" => $filter
            ];
            $res = $this->client->JobHunterExecuteNewQuery2($params)->JobHunterExecuteNewQuery2Result; //->Results;
            return $res;
        } catch (SoapFault $ex) {
            //var_dump($ex);
            throw new Exception('Error: SOAP Error: Check the log for more details.');
        } catch (Exception $ex) {
            throw new Exception('Error: Niloos services are not availiable, try later.');
        }
    }

    public function AutomaticHunterConfirmReset($hunter_id)
    {
        $transactionCode = NlsHelper::newGuid();
        try {
            $params = array(
                "transactionCode" => $transactionCode,
                "HunterId" => $hunter_id
            );
            $this->client->AutomaticHunterConfirmReset($params);
        } catch (SoapFault $ex) {
            //var_dump($ex);
            throw new Exception('Error: SOAP Error: Check the log for more details.');
        } catch (Exception $ex) {
            throw new Exception('Error: Niloos services are not availiable, try later.');
        }
    }
}
