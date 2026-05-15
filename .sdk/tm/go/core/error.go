package core

type NationalizeError struct {
	IsNationalizeError bool
	Sdk              string
	Code             string
	Msg              string
	Ctx              *Context
	Result           any
	Spec             any
}

func NewNationalizeError(code string, msg string, ctx *Context) *NationalizeError {
	return &NationalizeError{
		IsNationalizeError: true,
		Sdk:              "Nationalize",
		Code:             code,
		Msg:              msg,
		Ctx:              ctx,
	}
}

func (e *NationalizeError) Error() string {
	return e.Msg
}
