const ifNull = (value: null | undefined | string, defaultValue: null | undefined | string) => {
	return !value ? defaultValue : value.trim();
}

const ifBlank = (value: null | undefined | string, defaultValue: null | undefined | string) => {
	return !value || value.trim() === "" ? defaultValue : value.trim();
}

const nullIfBlank = (value: null | undefined | string) => {
	return ifBlank(value, null);
}

const blankIfNull = (value: null | undefined | string): string => {
	return ifNull(value, "")!;
}

const escapeIfNull = (value: null | undefined | string): string => {
	return ifNull(value, "\u00A0")!;
}

export const ValueOfStringUtil = {
	ifNull,
	ifBlank,
	nullIfBlank,
	blankIfNull,
	escapeIfNull,
}