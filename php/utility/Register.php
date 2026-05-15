<?php
declare(strict_types=1);

// Nationalize SDK utility registration

require_once __DIR__ . '/../core/UtilityType.php';
require_once __DIR__ . '/Clean.php';
require_once __DIR__ . '/Done.php';
require_once __DIR__ . '/MakeError.php';
require_once __DIR__ . '/FeatureAdd.php';
require_once __DIR__ . '/FeatureHook.php';
require_once __DIR__ . '/FeatureInit.php';
require_once __DIR__ . '/Fetcher.php';
require_once __DIR__ . '/MakeFetchDef.php';
require_once __DIR__ . '/MakeContext.php';
require_once __DIR__ . '/MakeOptions.php';
require_once __DIR__ . '/MakeRequest.php';
require_once __DIR__ . '/MakeResponse.php';
require_once __DIR__ . '/MakeResult.php';
require_once __DIR__ . '/MakePoint.php';
require_once __DIR__ . '/MakeSpec.php';
require_once __DIR__ . '/MakeUrl.php';
require_once __DIR__ . '/Param.php';
require_once __DIR__ . '/PrepareAuth.php';
require_once __DIR__ . '/PrepareBody.php';
require_once __DIR__ . '/PrepareHeaders.php';
require_once __DIR__ . '/PrepareMethod.php';
require_once __DIR__ . '/PrepareParams.php';
require_once __DIR__ . '/PreparePath.php';
require_once __DIR__ . '/PrepareQuery.php';
require_once __DIR__ . '/ResultBasic.php';
require_once __DIR__ . '/ResultBody.php';
require_once __DIR__ . '/ResultHeaders.php';
require_once __DIR__ . '/TransformRequest.php';
require_once __DIR__ . '/TransformResponse.php';

NationalizeUtility::setRegistrar(function (NationalizeUtility $u): void {
    $u->clean = [NationalizeClean::class, 'call'];
    $u->done = [NationalizeDone::class, 'call'];
    $u->make_error = [NationalizeMakeError::class, 'call'];
    $u->feature_add = [NationalizeFeatureAdd::class, 'call'];
    $u->feature_hook = [NationalizeFeatureHook::class, 'call'];
    $u->feature_init = [NationalizeFeatureInit::class, 'call'];
    $u->fetcher = [NationalizeFetcher::class, 'call'];
    $u->make_fetch_def = [NationalizeMakeFetchDef::class, 'call'];
    $u->make_context = [NationalizeMakeContext::class, 'call'];
    $u->make_options = [NationalizeMakeOptions::class, 'call'];
    $u->make_request = [NationalizeMakeRequest::class, 'call'];
    $u->make_response = [NationalizeMakeResponse::class, 'call'];
    $u->make_result = [NationalizeMakeResult::class, 'call'];
    $u->make_point = [NationalizeMakePoint::class, 'call'];
    $u->make_spec = [NationalizeMakeSpec::class, 'call'];
    $u->make_url = [NationalizeMakeUrl::class, 'call'];
    $u->param = [NationalizeParam::class, 'call'];
    $u->prepare_auth = [NationalizePrepareAuth::class, 'call'];
    $u->prepare_body = [NationalizePrepareBody::class, 'call'];
    $u->prepare_headers = [NationalizePrepareHeaders::class, 'call'];
    $u->prepare_method = [NationalizePrepareMethod::class, 'call'];
    $u->prepare_params = [NationalizePrepareParams::class, 'call'];
    $u->prepare_path = [NationalizePreparePath::class, 'call'];
    $u->prepare_query = [NationalizePrepareQuery::class, 'call'];
    $u->result_basic = [NationalizeResultBasic::class, 'call'];
    $u->result_body = [NationalizeResultBody::class, 'call'];
    $u->result_headers = [NationalizeResultHeaders::class, 'call'];
    $u->transform_request = [NationalizeTransformRequest::class, 'call'];
    $u->transform_response = [NationalizeTransformResponse::class, 'call'];
});
