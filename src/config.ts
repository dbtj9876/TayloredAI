// ============ Site-wide settings ============
// Change your booking page or form key here — every page picks it up.

// Your Microsoft Bookings public page URL (Bookings > your calendar > Copy link)
export const BOOKING_URL = 'https://outlook.office.com/bookwithme/';

// Web3Forms access key (free): https://web3forms.com — enter email, they send a key.
// Put it in a .env file as PUBLIC_WEB3FORMS_KEY=... (see .env.example)
export const FORM_KEY = (import.meta.env.PUBLIC_WEB3FORMS_KEY as string | undefined) ?? '';

export const SITE = {
  name: 'Taylored AI',
  url: 'https://tayloredai.com',
  email: 'info@tayloredai.com',
};