const compare = (search: string | null | undefined, target: string | null | undefined) => {
	const s = (search ?? "").toLowerCase().replaceAll(/[^0-9a-z]/g, "");
	const t = (target ?? "").toLowerCase().replaceAll(/[^0-9a-z]/g, "");
	return t.includes(s);
}

export const SearchUtil = {
	compare,
};