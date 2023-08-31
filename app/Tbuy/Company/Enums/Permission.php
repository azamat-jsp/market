<?php

namespace App\Tbuy\Company\Enums;

use App\Traits\PermissionTrait;

enum Permission: string
{
    use PermissionTrait;

    case VIEW_COMPANY = 'view company';
    case VIEW_COMPANY_EMPLOYEES = 'view company employees';
    case STORE_COMPANY = 'store company';
    case SHOW_COMPANY = 'show company';
    case UPDATE_COMPANY = 'update company';
    case DELETE_COMPANY = 'delete company';

    case SUBSCRIBE_COMPANY = 'subscribe company';
    case UNSUBSCRIBE_COMPANY = 'unsubscribe company';

    case TOGGLE_STATUS_COMPANY = 'toggle status company';

    case SCORE_COMPANY = 'score compnay';
    case INFO_COMPANY = 'info company';

    case UPDATE_COMPANY_LOGO = 'update company logo';

    case SEND_RESET_LINK_EMAIL = 'send reset link email';
    case SET_PASSWORD = 'set password';

    case DATA_CONFIRMATION = 'data confirmation';

    case COMPANY_VACANCY_LIST = 'company vacancy list';

    case VIEW_COMPANY_DOCUMENTS = 'view company documents';
}
