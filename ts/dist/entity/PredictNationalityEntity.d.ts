import { NationalizeEntityBase } from '../NationalizeEntityBase';
import type { NationalizeSDK } from '../NationalizeSDK';
import type { Control } from '../types';
import type { PredictNationality, PredictNationalityLoadMatch } from '../NationalizeTypes';
declare class PredictNationalityEntity extends NationalizeEntityBase<PredictNationality> {
    constructor(client: NationalizeSDK, entopts: any);
    make(this: PredictNationalityEntity): PredictNationalityEntity;
    load(this: any, reqmatch?: PredictNationalityLoadMatch, ctrl?: Control): Promise<PredictNationalityEntity>;
}
export { PredictNationalityEntity };
