const sort = (a: any, b: any, order: "asc" | "desc" = "asc") => {
	if (order === "asc") return a < b ? -1 : a > b ? 1 : 0;
	if (order === "desc") return a > b ? -1 : a < b ? 1 : 0;
	return 0;
}

export const SortUtil = {sort};