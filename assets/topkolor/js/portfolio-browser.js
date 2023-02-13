document.addEventListener('DOMContentLoaded', () => {
	const portfolio = new PortfolioBrowser(Utility.isHome());
});

class PortfolioBrowser {
	constructor(isHome = false) {
		this.navigation = {};
		this.navigation.all = document.querySelectorAll(dict.selectors.nav_all);
		this.navigation.topMenu = document.querySelectorAll(dict.selectors.nav_topMenu);

		switch (isHome) {
			case false:
				Utility.addEvents(this.navigation.topMenu, dict.events.nav, this.redirectOnClick);
				break;

			case true:
				this.init()
					.goToRedirectedAdress();
				break;

			default:
			//Throw error
		}
	}

	init() {
		this.firstOpen = true;

		this.browser = document.querySelector(dict.selectors.browser);
		this.indicatorArrow = this.browser.querySelector(dict.selectors.indicatorArrow);
		this.gallery = new Gallery(this.browser);
		this.navigation.CTA = document.querySelectorAll(dict.selectors.nav_CTA);
		this.navigation.closeBrowser = this.browser.querySelector(dict.selectors.nav_closeBrowser);
		this.navigation.dropdowns = {};

		dict.dropdown_types.forEach((type) => {
			this.navigation.dropdowns[type] = new DropdownCheckbox(this, type);
			const dropdown = this.navigation.dropdowns[type];

			dropdown.addUXEvents();
			dropdown.addSubscriber(this.browser, (e) => {
				//Reload gallery
			});

			if (type == dict.dropdown_types[1]) {

				this.navigation.CTA.forEach((button) => {

					dropdown.addSubscriber(button, () => {
						let CTAName = dict.classes.surfacesCTA;

						if (dropdown.selected.has(dict.classes.samplesCTA))
							CTAName = dict.classes.samplesCTA;
						this.toggleToCTA(this.findCTA(CTAName));
					});

				});
			}

		});

		this.addUXEvents();

		this.gallery.addCategory("Let's go bowling cousin", 12, "https://i.ytimg.com/vi/0eFB1eU4zps/hqdefault.jpg");

		return this;
	}


	//Non-home links Handlers
	redirectOnClick(e) {
		e.preventDefault();

		const url = new URL(e.currentTarget.getAttribute('href'), document.baseURI);
		const link = Utility.trimURL(url.pathname);
		const params = link.split("/");
		const paramQuery = new URLSearchParams();

		if (params[1] == undefined) params[1] = "";

		paramQuery.append("style", params[0]);
		paramQuery.append("kind", params[1]);

		window.location.href = `/?${paramQuery.toString()}`;
	}

	get getRequestParameters() {
		const URLParams = new URLSearchParams(window.location.search);
		const params = {
			style: URLParams.get("style"),
			kind: URLParams.get("kind"),
		}
		if (!(URLParams.has("style") && URLParams.has("kind"))) return false;
		return params;
	}

	goToRedirectedAdress() {
		const params = this.getRequestParameters;
		if (params) {
			const selector = `a[href*='/${params.style}/${params.kind}']`;
			if (document.querySelector(selector)) document.querySelector(selector).click();
		}
	}


	//Browser Window Methods
	openBrowser() {
		this.browser.classList.toggle(dict.classes.openBrowser, true);
		if (this.firstOpen) this.firstOpen = false;
	}

	closeBrowser() {
		this.browser.classList.toggle(dict.classes.openBrowser, false);
		this.deactivateCTA(this.activeCTA);
		this.resetIndicatorArrow();
	}

	get isBrowserOpened() {
		if (this.browser.classList.contains(dict.classes.openBrowser)) return true;
		return false;
	}


	//Indicator Arrow Methods
	updateIndicatorArrow() {
		const button = this.activeCTA;
		const x = Utility.getAbs(button).left;

		const buttonWidth = Utility.getDim(button).width;
		const pageWidth = document.documentElement.clientWidth;
		const arrowWidth = getComputedStyle(this.indicatorArrow)
			.getPropertyValue("--arrow-width")
			.match(/\d+/)[0];

		const posX = - (pageWidth - (x + buttonWidth / 2 + arrowWidth / 2));
		this.indicatorArrow.style.setProperty("--arrow-position", `${posX}px`);
	}

	resetIndicatorArrow() {
		this.indicatorArrow.style.setProperty("--arrow-position", "0px");
	}

	addUpdateIndicatorEvent() {
		const resizeEvent = "optimizedResize";

		Utility.throttle(dict.events.indicatorArrow, resizeEvent);
		window.addEventListener(resizeEvent, () => {
			if (this.isBrowserOpened) this.updateIndicatorArrow();
		});
	}


	//Call-To-Action Buttons Methods
	get activeCTA() {
		const CTA = this.navigation.CTA;

		for (let i = 0; i < CTA.length; i++) {
			if (CTA[i].classList.contains(dict.classes.activeCTA)) return CTA[i];
		}
	}

	findCTA(name) {
		const CTA = this.navigation.CTA;

		for (let i = 0; i < CTA.length; i++) {
			if (CTA[i].classList.contains(name)) return CTA[i];
		}
	}

	activateCTA(button) {
		button.classList.toggle(dict.classes.activeCTA, true);
	}

	deactivateCTA(button) {
		button.classList.toggle(dict.classes.activeCTA, false);
	}

	toggleToCTA(button) {
		if (this.activeCTA !== button) {
			if (this.isBrowserOpened) this.deactivateCTA(this.activeCTA);
			this.activateCTA(button);
			this.openBrowser();
			this.updateIndicatorArrow();
		}
	}

	setFromCTA(type) {
		const dropdowns = this.navigation.dropdowns;
		const kindsDropdown = dropdowns[dict.dropdown_types[1]];

		const surfaces = dict.classes.surfacesCTA;
		const samples = dict.classes.samplesCTA;

		switch (type) {
			case surfaces:
				if (this.firstOpen) {
					for (let key in dropdowns) dropdowns[key].selectAll([samples]);
					break;
				}

				if (kindsDropdown.selected.has(samples)) {
					if (kindsDropdown.recentlySwitched) {
						kindsDropdown.revertBack();
						break;
					}

					kindsDropdown.deleteSelected(samples);
					if (kindsDropdown.selected.size == 0) kindsDropdown.selectAll([samples]);
				}
				break;

			case samples:
				if (this.firstOpen) {
					for (let key in dropdowns) {
						let excludeArray = [samples];
						let blacklist = false;

						if (!Object.is(dropdowns[key], kindsDropdown)) {
							excludeArray = [];
							blacklist = true;
						}
						dropdowns[key].selectAll(excludeArray, blacklist);
					}
					break;
				}

				if (!kindsDropdown.selected.has(samples)) {
					kindsDropdown.selectAll([samples], false);
					kindsDropdown.recentlySwitched = true;
				}
				break;

			default:
		}
	}


	//Navigation Event Handlers
	all_onClick(e, self) {
		e.preventDefault();
		document.activeElement.blur();
	}

	topMenu_onClick(e, self) {
		const url = new URL(e.currentTarget.getAttribute('href'), document.baseURI);
		const link = Utility.trimURL(url.pathname);
		const types = dict.dropdown_types;

		for (let i = 0; i < types.length; i++) {
			const dropdown = self.navigation.dropdowns[types[i]];
			const value = link.split("/")[i];
			let array = [value];

			if (!dropdown.options.has(value)) array = [...dropdown.options];
			dropdown.selectFromArray(array);
		}

		self.openBrowser();
	}

	CTA_onClick(e, self) {
		let type;
		const surfaces = dict.classes.surfacesCTA;
		const samples = dict.classes.samplesCTA;

		switch (e.currentTarget) {
			case self.findCTA(surfaces):
				type = surfaces;
				break;

			case self.findCTA(samples):
				type = samples;
				break;

			default:
		}

		self.setFromCTA(type);
		self.toggleToCTA(e.currentTarget);
	}

	closeBrowser_onClick(e, self) {
		e.preventDefault();
		self.closeBrowser();
	}

	addUXEvents() {
		for (let key in this.navigation) {
			Utility.addEvents(this.navigation[key], "click", (e) => { this[`${key}_onClick`](e, this); });
		}
		this.addUpdateIndicatorEvent();
	}
}


class DropdownCheckbox {
	constructor(parent, type) {
		const dictionary = dict.selectors.nav_dropdown;

		this.parent = parent;
		this.node = this.parent.browser.querySelector(`${dictionary.node}.${type}`);
		this.panel = this.node.querySelector(dictionary.panel);
		this.arrow = this.node.querySelector(dictionary.arrow);
		this.list = this.node.querySelector(dictionary.list);
		this.currentSelection = this.node.querySelector(dictionary.currentSelection);
		this.defaultCaption = this.currentSelection.innerHTML;

		this.checkboxes = this.node.querySelectorAll(dictionary.checkboxes);
		this.options = new Set(
			[...(this.checkboxes)].map((checkbox) => {
				return checkbox.value;
			})
		);

		this.selected = new Set();
		this.oldSelected = new Set();
		this.recentlySwitched = false;

		this.updateEventName = `${type}Changed`;
		this.updateEvent = new CustomEvent(this.updateEventName, { detail: this.parent.firstOpen });

		this.subscribers = new Set();
	}


	//Subcsribers Methods
	addSubscriber(sub, callback) {
		sub.addEventListener(this.updateEventName, callback);
		this.subscribers.add(sub);
	}

	deleteSubscriber(sub, callback) {
		if (this.subscribers.has(sub)) {
			sub.removeEventLisener(this.updateEventName, callback);
			this.subscribers.delete(sub);
		}
	}

	dispatchToSubs(dispatchToSelf = true) {
		this.subscribers.forEach((sub) => {
			if ((Object.is(this.node, sub)) && (!dispatchToSelf)) return;
			sub.dispatchEvent(this.updateEvent);
		});
	}


	//Selection Methods
	addSelected(value, dispatchToSelf = true) {
		if (!this.selected.has(value)) {
			this.oldSelected = this.selected;
			this.selected.add(value);
			this.dispatchToSubs(dispatchToSelf);
		}
	}

	deleteSelected(value, dispatchToSelf = true) {
		if (this.selected.has(value)) {
			this.oldSelected = this.selected;
			this.selected.delete(value);
			this.dispatchToSubs(dispatchToSelf);
		}
	}

	selectFromArray(array, dispatchToSelf = true) {
		this.oldSelected = this.selected;
		this.selected = new Set(array);
		this.dispatchToSubs(dispatchToSelf);
	}

	revertBack(dispatchToSelf = true) {
		this.selectFromArray([...this.oldSelected], dispatchToSelf);
		this.recentlySwitched = false;
	}

	selectAll(excludeArray, blacklist = true, dispatchToSelf = true) {
		let selectionSet = Utility.setDifference(this.options, new Set(excludeArray));
		if (!blacklist) selectionSet = Utility.setDifference(this.options, selectionSet);
		this.selectFromArray([...selectionSet], dispatchToSelf);
	}


	//Updating (Redrawing) Methods
	updateCheckboxes() {
		this.checkboxes.forEach((checkbox) => {
			checkbox.checked = this.selected.has(checkbox.value);
		});
	}

	updatePanel() {
		const selectedCount = this.selected.size;
		this.currentSelection.innerHTML = `Выбрано (${selectedCount})`;
		if (selectedCount == 0) this.currentSelection.innerHTML = this.defaultCaption;
	}

	update() {
		this.updateCheckboxes();
		this.updatePanel();
	}


	//UX Methods
	toggleDropdown(state = undefined) {
		this.panel.classList.toggle("active", state);
		this.list.classList.toggle("shown", state);
		this.arrow.classList.toggle("opened", state);
	}

	addUXEvents() {
		this.panel.addEventListener("click", () => {
			this.toggleDropdown();
		});

		document.addEventListener("click", (e) => {
			const wasClickedInside = this.node.contains(e.target);
			if (!wasClickedInside)
				this.toggleDropdown(false);
		});

		Utility.addEvents(this.checkboxes, "change", (e) => {
			const checkbox = e.target;
			if (checkbox.checked)
				this.addSelected(checkbox.value, true);
			else
				this.deleteSelected(checkbox.value, true);
			this.updatePanel();
		});

		this.addSubscriber(this.node, (e) => {
			this.update();
			this.recentlySwitched = false;
		});
	}
}

class Gallery {
	constructor(parentNode) {
		this.node = parentNode.querySelector(".gallery");
		this.lightbox = new Lightbox(this.node);

		this.addUXEvents();
	}

	addGridItem(URL) {
		const image = document.createElement("img");
		image.setAttribute("data-uuid", Utility.UUID());
		image.setAttribute("src", URL);

		const picture = document.createElement("picture");
		picture.insertAdjacentElement("beforeend", image);

		const gridItem = Utility.createElementByClass("grid-item");
		gridItem.insertAdjacentElement("beforeend", picture);

		return gridItem;
	}

	addCategory(captionText, picturesCount, URL) {
		const caption = Utility.createElementByClass("caption")
		caption.insertAdjacentHTML("afterbegin", `<strong>${captionText}<strong>`);

		const imageGrid = Utility.createElementByClass("image-grid");
		for (let i = 0; i < picturesCount; i++) {
			imageGrid.insertAdjacentElement("beforeend", this.addGridItem(`${URL}`));
		}

		const category = Utility.createElementByClass("category")
		category.insertAdjacentElement("beforeend", caption)
		category.insertAdjacentElement("beforeend", imageGrid);

		this.node
			.querySelector(".categories-container")
			.insertAdjacentElement("beforeend", category);
	}


	get currentImageInGallery() {
		const UUID = this.lightbox.currentImage.getAttribute("data-uuid");
		return this.node.querySelector(`.category [data-uuid="${UUID}"]`);
	}

	imageGridItem(targetImage) {
		return targetImage.closest(".grid-item");
	}

	imageCategory(targetImage) {
		return targetImage.closest(".category");
	}


	canChangeImage(targetImage, isNextSibling = true) {
		return Utility.hasSibling(this.imageGridItem(targetImage), isNextSibling) ||
			Utility.hasSibling(this.imageCategory(targetImage), isNextSibling);
	}

	getDisablingObj(targetImage) {
		const disablingObj = {}
		const vars = this.lightbox.controlVariations;
		for (let i = 0; i < vars.length; i++) {
			disablingObj[vars[i]] = !this.canChangeImage(targetImage,
				this.lightbox.controlVariationBoolean(vars[i]));
		}
		return disablingObj;
	}

	openLightbox(targetImage) {
		this.lightbox.show(targetImage, this.getDisablingObj(targetImage));
	}

	advanceImage(isNext = true) {
		const targetImage = this.currentImageInGallery;

		if (this.canChangeImage(targetImage, isNext)) {
			const siblingOrder = isNext ? "next" : "previous";
			const childOrder = isNext ? "first" : "last";

			const gridItem = this.imageGridItem(targetImage);
			const category = this.imageCategory(targetImage);
			let newImage = targetImage;

			if (Utility.hasSibling(gridItem, isNext))
				newImage = gridItem[`${siblingOrder}Sibling`]
					.querySelector("img");

			if (Utility.hasSibling(category, isNext))
				newImage = category[`${siblingOrder}Sibling`]
					.querySelector(".image-grid")[`${childOrder}Child`]
					.querySelector("img");

			return this.lightbox.changeImage(newImage, this.getDisablingObj(newImage));
		}
	}


	addUXEvents() {
		this.node.addEventListener("click", (e) => {
			if (e.target.tagName.toLowerCase() == "picture") this.openLightbox(e.target);
		});

		this.lightbox.node.addEventListener("mousedown", (e) => {
			const wasClickedInside = this.lightbox.node.contains(e.target) && !Object.is(this.lightbox.node, e.target);
			if (!wasClickedInside) this.lightbox.hide();
		});

		for (let key in this.lightbox.controls) {
			this.lightbox.controls[key].addEventListener("click", () => {
				this.advanceImage(this.lightbox.controlVariationBoolean(key));
			});
		}

		const keyboardControlHandler = (e) => {
			if (this.lightbox.node.classList.contains("active")) {
				let controlVariation = null;
				const isKeyDown = e.type == "keydown" ? true : false;

				switch (e.code.toLowerCase()) {
					case "arrowleft":
						controlVariation = "prev";
						break;

					case "arrowright":
						controlVariation = "next";
						break;

					case "escape":
						if (isKeyDown) this.lightbox.hide();

					default:
						return;
				}

				this.lightbox.controls[controlVariation].classList.toggle("active", isKeyDown);
				if (!isKeyDown) this.advanceImage(this.lightbox.controlVariationBoolean(controlVariation));
			}
		}

		document.addEventListener("keydown", keyboardControlHandler);
		document.addEventListener("keyup", keyboardControlHandler);
	}
}


class Lightbox {
	constructor(parentNode) {
		this.node = parentNode.querySelector(".lightbox");
		this.bodyNode = document.querySelector("body");
		this.controlVariations = ["prev", "next"];
		this.controls = {};

		const cv = this.controlVariations;
		for (let key in cv) {
			this.controls[cv[key]] = this.node.querySelector(`#${cv[key]}`);
		}

	}

	get currentImage() {
		return this.node.querySelector("img");
	}

	controlVariationBoolean(value) {
		switch (value) {
			case this.controlVariations[0]:
				return false;

			case this.controlVariations[1]:
				return true;

			default:
				return;
		}
	}

	show(targetImage, needsDisabling) {
		this.bodyNode.classList.toggle("lightbox-active", true);
		this.node.classList.toggle("active", true);
		this.changeImage(targetImage.querySelector("img"), needsDisabling);
	}

	hide() {
		this.bodyNode.classList.toggle("lightbox-active", false);
		this.node.classList.toggle("active", false);
	}

	disableControl(needsDisabling) {
		for (let key in this.controls) {
			this.controls[key].classList.toggle("disabled", needsDisabling[key]);
		}
	}

	changeImage(targetImage, needsDisabling) {
		if (this.node.hasChildNodes()) Utility.removeChildNodesBySelector(this.node, "img");
		this.node.insertAdjacentElement("beforeend", targetImage.cloneNode(true));
		this.disableControl(needsDisabling);
	}
}


const Utility = {
	//Math Functions
	UUID() {
		return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (c) {
			let r = (Math.random() * 16) | 0,
				v = c == "x" ? r : (r & 0x3) | 0x8;
			return v.toString(16);
		});
	},

	randomInt(max) {
		return Math.floor(Math.random() * Math.floor(max));
	},

	setDifference(setA, setB) {
		let diff = new Set(setA);

		for (let elem of setB) diff.delete(elem);
		return diff;
	},


	//URL-related Functions
	trimURL(URL) {
		let startTrimmed = URL.startsWith('/') ? URL.slice(1) : URL;
		return startTrimmed.endsWith('/') ? startTrimmed.slice(0, -1) : startTrimmed;
	},

	isHome() {
		if (window.location.pathname !== "/") return false;
		return true;
	},

	//DOM Events-related Functions
	throttle(type, name, obj) {
		obj = obj || window;
		let running = false;
		let func = () => {
			if (running) { return; }
			running = true;
			requestAnimationFrame(() => {
				obj.dispatchEvent(new CustomEvent(name));
				running = false;
			});
		};
		obj.addEventListener(type, func);
	},

	addEvents(elementsArray, eventListener, callbackFunction) {
		if (NodeList.prototype.isPrototypeOf(elementsArray)) {
			for (let i = 0; i < elementsArray.length; i++)
				elementsArray[i].addEventListener(eventListener, callbackFunction);
			return;
		}

		if (Node.prototype.isPrototypeOf(elementsArray))
			elementsArray.addEventListener(eventListener, callbackFunction);
	},


	//DOM Manipulation Functions
	createElementByClass(elementClass, tagName = "div") {
		const element = document.createElement(tagName);

		element.classList.add(elementClass);
		return element;
	},

	removeChildNodesBySelector(parentNode, selector) {
		const childs = parentNode.querySelectorAll(selector);

		childs.forEach((childNode) => {
			parentNode.removeChild(childNode);
		});
	},

	hasSibling(node, needNextSibling = true) {
		if (needNextSibling) return !!node.nextSibling;
		return !!node.previousSibling;
	},


	//DOM Coordinates-related Functions
	getRel(element) {
		const boundingRectangle = element.getBoundingClientRect();

		return {
			top: boundingRectangle.top,
			left: boundingRectangle.left,
		}
	},

	getAbs(element) {
		const relativeCoords = this.getRel(element);

		return {
			top: relativeCoords.top + window.scrollY,
			left: relativeCoords.left + window.scrollX,
		}
	},

	getDim(element) {
		const boundingRectangle = element.getBoundingClientRect();

		return {
			width: boundingRectangle.width,
			height: boundingRectangle.height,
		}
	},
}

const dict = {
	selectors: {
		browser: ".tk-section.portfolio",
		indicatorArrow: ".container.main",

		nav_all: "a.portfolio-link",
		nav_topMenu: "a.portfolio-link:not(.portfolio-cta)",
		nav_CTA: "a.portfolio-cta",

		nav_dropdown: {
			node: ".dropdown-checkbox",
			panel: ".panel-container",
			arrow: ".arrow-container",
			list: ".list-container",
			checkboxes: "input[type='checkbox']",
			currentSelection: ".current-selection",
		},

		nav_closeBrowser: ".container.navigation .close",
	},

	classes: {
		openBrowser: "shown",
		activeCTA: "active",
		surfacesCTA: "surfaces",
		samplesCTA: "samples",
	},

	events: {
		nav: "click",
		indicatorArrow: "resize",
	},

	CSS_properties: {
		arrow: {
			height: "--arrow-height",
			width: "--arrow-width",
			position: "--arrow-position",
		},
	},

	dropdown_types: ["styles", "kinds"],
}