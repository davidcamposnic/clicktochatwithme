import axios from "axios";

export class Dashboard {
  async createName(data) {
    axios.defaults.headers.common["X-WP-Nonce"] = clickToChatData.nonce;

    const dataFormatted = {
      data,
    };

    try {
      const response = await axios.post(
        `${clickToChatData.root_url}/wp-json/clicktochat/v1/data/name`,
        dataFormatted
      );
      return response;
    } catch (error) {
      throw error;
    }
  }
  async getData() {
    try {
      const response = await axios.get(
        `${clickToChatData.root_url}/wp-json/clicktochat/v1/data/`
      );
      return response;
    } catch (error) {
      throw error;
    }
  }

  async createMessages(data) {
    axios.defaults.headers.common["X-WP-Nonce"] = clickToChatData.nonce;

    const dataFormatted = {
      data,
    };

    try {
      const response = await axios.post(
        `${clickToChatData.root_url}/wp-json/clicktochat/v1/data/messages`,
        dataFormatted
      );
      return response;
    } catch (error) {
      throw error;
    }
  }
}
