import { Context } from './Context';
declare class NationalizeError extends Error {
    isNationalizeError: boolean;
    sdk: string;
    code: string;
    ctx: Context;
    status: number;
    get notFound(): boolean;
    constructor(code: string, msg: string, ctx: Context);
}
export { NationalizeError };
