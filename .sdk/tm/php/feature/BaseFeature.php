<?php
declare(strict_types=1);

// Nationalize SDK base feature

class NationalizeBaseFeature
{
    public string $version;
    public string $name;
    public bool $active;

    public function __construct()
    {
        $this->version = '0.0.1';
        $this->name = 'base';
        $this->active = true;
    }

    public function get_version(): string { return $this->version; }
    public function get_name(): string { return $this->name; }
    public function get_active(): bool { return $this->active; }

    public function init(NationalizeContext $ctx, array $options): void {}
    public function PostConstruct(NationalizeContext $ctx): void {}
    public function PostConstructEntity(NationalizeContext $ctx): void {}
    public function SetData(NationalizeContext $ctx): void {}
    public function GetData(NationalizeContext $ctx): void {}
    public function GetMatch(NationalizeContext $ctx): void {}
    public function SetMatch(NationalizeContext $ctx): void {}
    public function PrePoint(NationalizeContext $ctx): void {}
    public function PreSpec(NationalizeContext $ctx): void {}
    public function PreRequest(NationalizeContext $ctx): void {}
    public function PreResponse(NationalizeContext $ctx): void {}
    public function PreResult(NationalizeContext $ctx): void {}
    public function PreDone(NationalizeContext $ctx): void {}
    public function PreUnexpected(NationalizeContext $ctx): void {}
}
