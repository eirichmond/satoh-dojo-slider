/**
 * WordPress dependencies
 */
import { store, getContext } from '@wordpress/interactivity';

// Helper function to update position
function updatePosition(currentIndex) {
    const container = document.querySelector(".carousel-container");
    if (container) {
        const offset = -currentIndex * 100; // Assume each item is 100% width
        container.style.transform = `translateX(${offset}%)`;
    }
}

const { state } = store("create-block", {
	state: {
		currentIndex: 0, // Track current visible item
		items: 3, // Total number of items (adjust based on your setup)
	},
	actions: {
		slideLeft() {
			const { currentIndex, items } = state;
			state.currentIndex = (currentIndex - 1 + items) % items; // Circular navigation
			updatePosition(state.currentIndex); // Call the update function directly
		},
		slideRight() {
			const { currentIndex, items } = state;
			state.currentIndex = (currentIndex + 1) % items; // Circular navigation
			updatePosition(state.currentIndex); // Call the update function directly
		},
	}
});
