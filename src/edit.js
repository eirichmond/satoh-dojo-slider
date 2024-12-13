/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps, InspectorControls, RichText } from "@wordpress/block-editor";
import { PanelBody, RangeControl, SelectControl } from "@wordpress/components";
import { useSelect } from "@wordpress/data";
import { store as coreDataStore } from "@wordpress/core-data";

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @param {Object}   props               Properties passed to the function.
 * @param {Object}   props.attributes    Available block attributes.
 * @param {Function} props.setAttributes Function that updates individual attributes.
 *
 * @return {Element} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const { title, items, itemsPerView, itemType } = attributes;

	const postTypes = useSelect(select => {

		return select(coreDataStore).getPostTypes({ per_page: -1 });
		// Equivalent to:
		// select( coreDataStore ).getEntityRecords( 'root', 'postType', { per_page: 4 } );
	});


	// Fetch post types for the dropdown
	// const postTypes = useSelect(select => {
	// 	const { getPostTypes } = select("core");
	// 	return getPostTypes ? getPostTypes({ per_page: -1 }) : [];
	// }, []);

	// Apply block-specific props
	const blockProps = useBlockProps({
		className: "carousel-block",
	});
	// const blockProps = useBlockProps();

	// Handle loading and empty state
	let postTypeOptions = [];
	if (postTypes) {
		postTypeOptions = postTypes.map(type => ({
			label: type.name,
			value: type.slug,
		}));
	} else {
		postTypeOptions = [
			{ label: __("Loading...", "text-domain"), value: "" },
		];
	}

	return (
		<div {...blockProps}>
			<InspectorControls>
				<PanelBody title={__("Carousel Settings", "text-domain")}>
					<RangeControl
						label={__("Number of Items", "text-domain")}
						value={items}
						onChange={value => setAttributes({ items: value })}
						min={1}
						max={20}
					/>
					<RangeControl
						label={__("Items Per View", "text-domain")}
						value={itemsPerView}
						onChange={value =>
							setAttributes({ itemsPerView: value })
						}
						min={1}
						max={10}
					/>
					<SelectControl
						label={__("Select Post Type", "text-domain")}
						value={itemType}
						options={postTypeOptions}
						onChange={value => setAttributes({ itemType: value })}
					/>
				</PanelBody>
			</InspectorControls>
			<div>
				<RichText
					tagName='p'
					placeholder='Title'
					value={title}
					onChange={value => setAttributes({ title: value })}
					className='carousel-title'
				/>

				<h2>{__("Carousel Preview", "text-domain")}</h2>
				<p>
					{__("Selected Post Type: ", "text-domain")}
					{itemType || __("None", "text-domain")}
				</p>
				<p>
					{__("Items: ", "text-domain")}
					{items}
				</p>
				<p>
					{__("Items Per View: ", "text-domain")}
					{itemsPerView}
				</p>
				{/* Add a visual placeholder for preview if necessary */}
			</div>
		</div>
	);
}
