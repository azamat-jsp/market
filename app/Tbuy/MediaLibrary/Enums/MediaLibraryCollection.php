<?php

namespace App\Tbuy\MediaLibrary\Enums;

enum MediaLibraryCollection: string
{
    case BRAND_LOGO = 'logo';
    case PRODUCT_MEDIA = 'product-media';
    case PRODUCT_MEDIA_MAIN = 'product-media-main';
    case MENU_IMAGE = 'menu-image';
    case VACANCY_MEDIA = 'vacancy-media';

    case RESUME = 'resume';
    case COMPANY_BRAND_DOCUMENT = 'company-brand-document';
    case COMPANY_PASSPORT_DOCUMENT = 'company-passport-document';
    case COMPANY_STATE_REGISTER_DOCUMENT = 'company-state-register-document';
    case COMPANY_LOGO = 'company-logo';
    case COMPANY_IDENTITY = 'company-identity';
    case BRAND_CERTIFICATE = 'brand-certificate';
    case PHOTO = 'photo';
    case VIDEO = 'video';
    case CATEGORY_LOGO = 'category-logo';
    case CATEGORY_ICON = 'category-icon';
    case BANNER_FILE = 'banner-file';
}
