<?php

class NlsConfig
{
    const NLS_FLOW_ELEMENTS = 3;
    const NLS_JOBS_COUNT_DEFAULT = 20;
    const NLS_HOT_JOBS_COUNT_DEFAULT = 6;

    const NLS_DIRECTORY_SERVICE = 'nls_directory_service';
    const NLS_DIRECTORY_SERVICE_DEFAULT = 'https://hunterdirectory.hunterhrms.com/DirectoryManagementService.svc?wsdl';
    const NLS_CARDS_SERVICE = 'nls_cards_service';
    const NLS_CARDS_SERVICE_DEFAULT = 'https://huntercards.hunterhrms.com/HunterCards.svc?wsdl';
    const NLS_SECURITY_SERVICE = 'nls_security_service';
    const NLS_SECURITY_SERVICE_DEFAULT = 'https://hunterdirectory.hunterhrms.com/SecurityService.svc?wsdl';
    const NLS_SEARCH_SERVICE = 'nls_search_service';
    const NLS_SEARCH_SERVICE_DEFAULT = 'https://huntersearchengine.hunterhrms.com/SearchEngineHunterService.svc?wsdl';

    const NLS_CONSUMER = 'nls_consumer';
    const NLS_SUPPLIER_ID = 'nls_supplier_id';
    const NLS_HOT_JOBS_SUPPLIER_ID = 'nls_hot_jobs_supplier_id';
    const NLS_TO_WEBMAIL = 'nls_to_webmail';
    const NLS_BCC_MAIL = 'nls_bcc_mail';

    const NLS_DOMAIN = 'nls_domain';
    const NLS_USER = 'nls_user';
    const NLS_PASSWORD = 'nls_password';

    const NLS_JOBS_COUNT = 'nls_job_count';
    const NLS_HOT_JOBS_COUNT = 'nls_hot_job_count';


    private $nlsDirectoryService;
    private $nlsCardsService;
    private $nlsSecurityService;
    private $nlsSearchService;

    private $nlsConsumer;
    private $nlsSupplierId;
    private $nlsHotJobsSupplierId;
    private $nlsToWebmail;
    private $nlsBccMail;

    private $nlsDomain;
    private $nlsUser;
    private $nlsPassword;

    private $nlsJobCount;
    private $nlsHotJobCount;

    public function __construct()
    {
        $this->nlsDirectoryService = get_option('setting_' . self::NLS_DIRECTORY_SERVICE, self::NLS_DIRECTORY_SERVICE_DEFAULT);
        $this->nlsCardsService = get_option('setting_' . self::NLS_CARDS_SERVICE, self::NLS_CARDS_SERVICE_DEFAULT);
        $this->nlsSecurityService = get_option('setting_' . self::NLS_SECURITY_SERVICE, self::NLS_SECURITY_SERVICE_DEFAULT);
        $this->nlsSearchService = get_option('setting_' . self::NLS_SEARCH_SERVICE, self::NLS_SEARCH_SERVICE_DEFAULT);

        $this->nlsConsumer = get_option('setting_' . self::NLS_CONSUMER, '');
        $this->nlsSupplierId = get_option('setting_' . self::NLS_SUPPLIER_ID, '');
        $this->nlsHotJobsSupplierId = get_option('setting_' . self::NLS_HOT_JOBS_SUPPLIER_ID, '');
        $this->nlsToWebmail = get_option('setting_' . self::NLS_TO_WEBMAIL, '');
        $this->nlsBccMail = get_option('setting_' . self::NLS_BCC_MAIL, '');

        $this->nlsDomain = get_option('setting_' . self::NLS_DOMAIN, '');
        $this->nlsUser = get_option('setting_' . self::NLS_USER, '');
        $this->nlsPassword = get_option('setting_' . self::NLS_PASSWORD, '');

        $this->nlsJobCount = get_option('setting_' . self::NLS_JOBS_COUNT, self::NLS_JOBS_COUNT_DEFAULT);
        $this->nlsHotJobCount = get_option('setting_' . self::NLS_HOT_JOBS_COUNT, self::NLS_HOT_JOBS_COUNT_DEFAULT);
    }

    public function getNlsDirectoryService()
    {
        return $this->nlsDirectoryService;
    }
    public function getNlsCardsService()
    {
        return $this->nlsCardsService;
    }
    public function getNlsSecurityService()
    {
        return $this->nlsSecurityService;
    }
    public function getNlsSearchService()
    {
        return $this->nlsSearchService;
    }
    public function getNlsConsumer()
    {
        return $this->nlsConsumer;
    }
    public function getNlsSupplierId()
    {
        return $this->nlsSupplierId;
    }
    public function getNlsToWebmail()
    {
        return $this->nlsToWebmail;
    }
    public function getNlsBccMail()
    {
        return $this->nlsBccMail;
    }
    public function getNlsHotJobsSupplierId()
    {
        return $this->nlsHotJobsSupplierId;
    }
    public function getNlsDomain()
    {
        return $this->nlsDomain;
    }
    public function getNlsUser()
    {
        return $this->nlsUser;
    }
    public function getNlsPassword()
    {
        return $this->nlsPassword;
    }
    public function getNlsJobsCount()
    {
        return intval($this->nlsJobCount);
    }
    public function getNlsHotJobsCount()
    {
        return intval($this->nlsHotJobCount);
    }
}
