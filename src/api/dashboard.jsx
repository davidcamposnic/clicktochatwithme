import axios from "axios";

export class Dashboard {
  async create(data) {
    axios.defaults.headers.common["X-WP-Nonce"] = clickToChatData.nonce;

    const dataFormatted = {
      data,
    };

    try {
      const response = await axios.post(
        `${clickToChatData.root_url}/wp-json/clicktochat/v1/dashboard/`,
        dataFormatted
      );
      return response;
    } catch (error) {
      throw error;
    }
  }
}
