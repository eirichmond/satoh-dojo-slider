/**
 * WordPress dependencies
 */
import { store, getContext } from '@wordpress/interactivity';

const { state } = store("create-block", {
	actions: {
		slideLeft() {
            const context = getContext();
			const totalItems = context.items;
			const itemsPerView = context.itemsPerView;
			context.currentIndex = (context.currentIndex - itemsPerView + totalItems) % totalItems;
			const offset = -context.currentIndex * (100 / itemsPerView); // Adjust offset per item width
			context.transform = `translateX(${offset}%)`;		},
		slideRight() {
            const context = getContext();
			const totalItems = context.items;
			const itemsPerView = context.itemsPerView;
			context.currentIndex = (context.currentIndex + itemsPerView) % totalItems;
			const offset = -context.currentIndex * (100 / itemsPerView); // Adjust offset per item width
			context.transform = `translateX(${offset}%)`;
		},
	}
});
