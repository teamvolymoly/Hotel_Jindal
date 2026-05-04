const menuButton = document.getElementById("menuButton");
const mobileMenu = document.getElementById("mobileMenu");
const navBg = document.getElementById("navBg");
const navShell = document.getElementById("navShell");
const roomsToggle = document.getElementById("roomsToggle");
const roomsMenu = document.getElementById("roomsMenu");

menuButton?.addEventListener("click", () => {
    mobileMenu?.classList.toggle("hidden");
});

const setRoomsNavTheme = (isOpen) => {
    navBg?.classList.toggle("bg-[#f1f1f1]", isOpen);
    navShell?.classList.toggle("text-black", isOpen);
    navShell?.classList.toggle("text-white", !isOpen);
};

const openRoomsMenu = () => {
    roomsMenu?.classList.remove("hidden");
    roomsToggle?.setAttribute("aria-expanded", "true");
    setRoomsNavTheme(true);
};

const closeRoomsMenu = () => {
    roomsMenu?.classList.add("hidden");
    roomsToggle?.setAttribute("aria-expanded", "false");
    setRoomsNavTheme(false);
};

let roomsCloseTimer;

const clearRoomsCloseTimer = () => {
    if (roomsCloseTimer) {
        clearTimeout(roomsCloseTimer);
        roomsCloseTimer = null;
    }
};

const scheduleRoomsClose = () => {
    clearRoomsCloseTimer();
    roomsCloseTimer = setTimeout(() => {
        closeRoomsMenu();
    }, 220);
};

roomsToggle?.addEventListener("mouseenter", () => {
    clearRoomsCloseTimer();
    openRoomsMenu();
});

roomsToggle?.addEventListener("mouseleave", () => {
    scheduleRoomsClose();
});

roomsMenu?.addEventListener("mouseenter", () => {
    clearRoomsCloseTimer();
    openRoomsMenu();
});

roomsMenu?.addEventListener("mouseleave", () => {
    scheduleRoomsClose();
});

document.addEventListener("click", () => {
    closeRoomsMenu();
});

document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
        closeRoomsMenu();
    }
});
