const ifNull = (value: null | undefined | number, defaultValue: null | undefined | number) => {
	return value == null ? defaultValue : value;
}

const ifZero = (value: null | undefined | number, defaultValue: null | undefined | number) => {
	return value == null || value === 0 ? defaultValue : value;
}

const nullIfZero = (value: null | undefined | number): null | number => {
	return ifZero(value, null) ?? null;
}

const zeroIfNull = (value: null | undefined | number): number => {
	return ifNull(value, 0) ?? 0;
}

const intersect = (input: number[][]): number[] => {
	if (input.length === 0) return [];
	const sets = input.slice(1).map(row => new Set(row));
	return [...new Set(input[0])].filter(value => sets.every(set => set.has(value)));
};

const difference = (input: number[][]): number[] => {
	const count = new Map<number, number>();
	input.flat().forEach(value => count.set(value, (count.get(value) ?? 0) + 1));
	return [...count.entries()].filter(([_, total]) => total === 1).map(([value]) => value);
};

const intoFormat = (value: null | number, fraction: number = -1): string => {
	if (value == null || isNaN(Number(value))) return "";
	const isNegative = value < 0;

	if (fraction === -1) {
		let toString = value.toString();
		if (toString.includes(".")) {
			toString = toString.substring(toString.indexOf(".") + 1);
			fraction = toString.length;
		}
	}

	let from = isNegative ? -value : value;
	let into = from.toLocaleString("id-ID");

	if (fraction > -1) {
		const factor = Math.pow(10, fraction);
		from = Math.round(from * factor) / factor;
		into = from.toLocaleString("id-ID");
	}

	if (fraction === 0) into = from.toLocaleString("id-ID", {minimumFractionDigits: 0, maximumFractionDigits: 0});
	if (fraction > 0) into = from.toLocaleString("id-ID", {minimumFractionDigits: fraction, maximumFractionDigits: fraction});

	return isNegative ? `(${into})` : into;
}

const fromFormat = (value: null | string, fraction: number = -1): number => {
	if (!value || value.trim() === "") return 0;
	const noThousands = value.replace(/\./g, "");
	const normalized = noThousands.replace(",", ".");
	const number = Number(normalized);
	if (isNaN(number)) return 0;
	if (fraction === -1) return number;
	const factor = Math.pow(10, fraction);
	return Math.round(number * factor) / factor;
}

export const ValueOfNumberUtil = {
	ifNull,
	ifZero,
	intersect,
	difference,
	nullIfZero,
	zeroIfNull,
	fromFormat,
	intoFormat,
}