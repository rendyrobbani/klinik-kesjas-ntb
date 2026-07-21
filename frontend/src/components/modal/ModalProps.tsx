export type ModalProps = {
	uuid: string,
	type: number,
	message: string,
	dispose: () => void;
}